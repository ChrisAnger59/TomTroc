<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\UserManager;
use App\Repositories\BookManager;
use App\Services\UserValidator;
use App\Services\Auth;
use App\Services\ImageUploader;
use App\Models\User;

class UserController
{
    private UserManager $userManager;
    private BookManager $bookManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->bookManager = new BookManager();
    }

    public function showLogin(): void
    {
        (new View())->render("loginForm", [
            "titre" => "Se Connecter",
            "action" => "connectUser",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signinForm",
            "textLink" => "Inscrivez-vous",
            "redirectFromProfil" => false
        ]);
    }

    public function showSignIn(): void
    {
        (new View())->render("loginForm", [
            "titre" => "Inscription",
            "action" => "register",
            "signin" => true,
            "buttonText" => "S'inscrire",
            "mentionLink" => "Déjà inscrit ?",
            "link" => "index.php?action=loginForm",
            "textLink" => "Connectez-vous",
            "redirectFromProfil" => false
        ]);
    }

    public function showUser(): void
    {
        Auth::requireLogin();

        try {
            $user = $this->userManager->getUserById(Auth::getLoggedUserId());

            if (!$user) {
                Utils::redirectWithMessage("home", "Utilisateur introuvable");
                return;
            }

            $books = $this->bookManager->getBooksOfUser($user);

            (new View())->render('profil', [
                'user' => $user,
                'books' => $books
            ]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("home", $e->getMessage());
        }
    }

    public function addUser(): void
    {
        $email = Utils::request('email');
        $nickname = Utils::request('nickname');
        $password = Utils::request('password');

        $validator = new UserValidator();

        if (!$validator->validateRegister($email, $nickname, $password)) {
            Utils::redirectToSignin(implode(', ', $validator->getErrors()));
            return;
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->userManager->addUser($nickname, $email, $hashedPassword);

            Utils::redirect('loginForm');

        } catch (\Exception $e) {
            Utils::redirectToSignin($e->getMessage());
        }
    }

    public function connectUser(): void
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        $validator = new UserValidator();

        if (!$validator->validateLogin($email, $password)) {
            Utils::redirectToLogin(implode(', ', $validator->getErrors()));
            return;
        }

        try {
            $user = $this->userManager->getUserByEmail($email);

            if ($user && $user->verifyPassword($password)) {
                $_SESSION['id'] = $user->getId();
                Utils::redirect('home');
                return;
            }

            Utils::redirectToLogin("Identifiants incorrects");

        } catch (\Exception $e) {
            Utils::redirectToLogin($e->getMessage());
        }
    }

    public function updatePersonalInfo(): void
    {
        Auth::requireLogin();

        $email = Utils::request('email');
        $password = Utils::request('password');
        $nickname = Utils::request('nickname');

        $validator = new UserValidator();

        if (!$validator->validateUpdate($email, $nickname, $password)) {
            Utils::redirectWithMessage("profil", implode(', ', $validator->getErrors()));
            return;
        }

        try {
            $user = $this->userManager->getUserById(Auth::getLoggedUserId());

            if (!$user) {
                Utils::redirectWithMessage("profil", "Utilisateur introuvable");
                return;
            }

            $user->updateUserInfo($email, $nickname, $password);
            $this->userManager->updateUser($user);

            Utils::redirect('profil');

        } catch (\Exception $e) {
            Utils::redirectWithMessage("profil", $e->getMessage());
        }
    }

    public function showPublicUser(): void
    {
        $idUser = filter_var(Utils::request("id"), FILTER_VALIDATE_INT);

        if (!$idUser) {
            Utils::redirectWithMessage("home", "Utilisateur invalide");
            return;
        }

        try {
            $user = $this->userManager->getUserById($idUser);

            if (!$user) {
                Utils::redirectWithMessage("home", "Utilisateur introuvable");
                return;
            }

            $books = $this->bookManager->getBooksOfUser($user);

            (new View())->render('detailUser', [
                'user' => $user,
                'books' => $books
            ]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("home", $e->getMessage());
        }
    }

    public function uploadProfilePicture(): void
    {
        Auth::requireLogin();

        if (!isset($_FILES['photo'])) {
            Utils::redirectWithMessage("profil", "Aucune image envoyée");
            return;
        }

        try {
            $user = $this->userManager->getUserById(Auth::getLoggedUserId());

            if (!$user) {
                Utils::redirectWithMessage("profil", "Utilisateur introuvable");
                return;
            }

            $uploader = new ImageUploader();
            $imagePath = $uploader->upload($_FILES['photo'], 'users');

            $oldPath = $user->getProfilePicturePath();

            if ($oldPath && file_exists($oldPath) && $oldPath !== User::DEFAULT_PPP) {
                unlink($oldPath);
            }

            $this->userManager->updateProfilePicturePath($user, $imagePath);

            Utils::redirect('profil');

        } catch (\Exception $e) {
            Utils::redirectWithMessage("profil", $e->getMessage());
        }
    }

    public function disconnectUser(): void
    {
        $_SESSION = [];
        session_destroy();

        Utils::redirect('loginForm');
        exit;
    }
}