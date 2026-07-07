<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\UserManager;
use App\Repositories\BookManager;
use App\Services\UserValidator;
use App\Services\Auth;

class UserController
{

    public function showUser()
    {
        if (!Auth::isLogged()) {
            (new View())->render('loginForm', [
                "titre" => "Se Connecter",
                "action" => "connectUser",
                "signin" => false,
                "buttonText" => "Se Connecter",
                "mentionLink" => "Pas de compte ?",
                "link" => "index.php?action=signinForm",
                "textLink" => "Inscrivez-vous",
                "redirectFromProfil" => true,
                "errorMessage" => "Veuillez vous connecter"
            ]);
            return;
        }

        $userId = Auth::getLoggedUserId();

        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksOfUser($user);

        $errorMessage = $_SESSION['errorMessage'] ?? null;
        unset($_SESSION['errorMessage']);

        (new View())->render('profil', [
            'user' => $user,
            'books' => $books,
            'errorMessage' => $errorMessage
        ]);
    }

    public function showLogin()
    {
        $errorMessage = $_SESSION['errorMessage'] ?? null;

        unset($_SESSION['errorMessage']);

        $view = new View();
        $view->render("loginForm", [
            "titre" => "Se Connecter",
            "action" => "connectUser",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signinForm",
            "textLink" => "Inscrivez-vous",
            "redirectFromProfil" => false,
            "errorMessage" => $errorMessage

        ]);
    }

    public function showSignIn()
    {
        $errorMessage = $_SESSION['errorMessage'] ?? null;

        unset($_SESSION['errorMessage']);

        $view = new View();
        $view->render("loginForm", [
            "titre" => "Inscription",
            "action" => "register",
            "signin" => true,
            "buttonText" => "S'inscrire",
            "mentionLink" => "Déjà inscrit ?",
            "link" => "index.php?action=loginForm",
            "textLink" => "Connectez-vous",
            "redirectFromProfil" => false,
            "errorMessage" => $errorMessage
        ]);
    }


    public function addUser()
    {
        $email = Utils::request('email');
        $nickname = Utils::request('nickname');
        $password = Utils::request('password');

        $validator = new UserValidator();

        if (!$validator->validateRegister($email, $nickname, $password)) {
            $_SESSION['errorMessage'] = implode(', ', $validator->getErrors());
            Utils::redirect('signinForm');
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userManager = new UserManager();
        $userManager->addUser($nickname, $email, $hashedPassword);

        Utils::redirect('loginForm');
    }


    public function connectUser()
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        $validator = new UserValidator();

        if (!$validator->validateLogin($email, $password)) {
            $_SESSION['errorMessage'] = implode(', ', $validator->getErrors());
            Utils::redirect('loginForm');
            return;
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user && $user->verifyPassword($password)) {
            $_SESSION['id'] = $user->getId();
            Utils::redirect('home');
        } else {
            $_SESSION['errorMessage'] = "Identifiants incorrects";
            Utils::redirect('loginForm');
        }
    }

    public function disconnectUser()
    {
        $_SESSION = [];

        session_destroy();

        Utils::redirect('loginForm');
        exit;
    }

    public function updatePersonalInfo(): void
    {
        Auth::requireLogin();

        $email = Utils::request('email');
        $password = Utils::request('password');
        $nickname = Utils::request('nickname');

        $validator = new UserValidator();

        if (!$validator->validateUpdate($email, $nickname, $password)) {
            $_SESSION['errorMessage'] = implode(', ', $validator->getErrors());
            Utils::redirect('profil');
            return;
        }

        $userId = Auth::getLoggedUserId();

        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        if (!$user) {
            $_SESSION['errorMessage'] = "Utilisateur introuvable";
            Utils::redirect('profil');
            return;
        }

        $user->updateUserInfo($email, $nickname, $password);
        $userManager->updateUser($user);

        Utils::redirect('profil');
    }

    public function showPublicUser()
    {
        $idUser = Utils::request("id", -1);
        $idUser = filter_var($idUser, FILTER_VALIDATE_INT);
        
        $userManager = new UserManager();
        $user = $userManager->getUserById($idUser);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksOfUser($user);

        $view = new View();
        $view->render('detailUser', [
            'user' => $user,
            'books' => $books
        ]);
        
    }


    /**
     * TRAITEMENT UPLOAD IMAGE PROFIL
     */

    public function uploadProfilePicture()
    {
        Auth::requireLogin();

        if (!isset($_FILES['photo'])) {
            return;
        }

        $tmp_name = $_FILES['photo']['tmp_name'];
        $file_size = $_FILES['photo']['size'];

        $mime = mime_content_type($tmp_name);
        $allowed = ['image/jpg', 'image/jpeg', 'image/png'];

        if (!in_array($mime, $allowed)) {
            echo "Type de fichier invalide";
            return;
        }

        if ($file_size > 5000000) {
            echo "Fichier trop volumineux";
            return;
        }

        $file_extension = str_replace("/", ".", strrchr($_FILES['photo']['type'], "/"));
        $file_name = uniqid() . $file_extension;

        $folder = './../public/uploads/users/';
        $imagePath = $folder . $file_name;

        $userId = Auth::getLoggedUserId();

        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        if ($user->getProfilePicturePath() && file_exists($user->getProfilePicturePath())) {
            unlink($user->getProfilePicturePath());
        }

        if (move_uploaded_file($tmp_name, $imagePath)) {
            $userManager->updateProfilePicturePath($user, $imagePath);
            Utils::redirect('profil');
        }
    }
}