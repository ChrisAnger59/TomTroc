TomTroc

TomTroc est une application web permettant aux utilisateurs d’échanger des livres entre eux via une interface simple et un système de messagerie.

----------------------------------------------------------------------------------------------------

Fonctionnalités
- Inscription et connexion des utilisateurs
- Gestion du profil utilisateur (édition infos + photo)
- Modifications et suppression de livres
- Consultation des livres dispo
- Upload d'images (couverture de livre et photo de profil)
- Système de messagerie entre utilisateur

----------------------------------------------------------------------------------------------------

Architecture

le projet repose sur une architecture MVC, sans librairie tierce ou framework

Organisation:
- Controllers: Gestion des requêtes HTTP et orchestration
- Services: Logique métier (validation, authentification, upload...)
- Repositories: Accès aux données (SQL, PDO)
- Models: Représentation des entités
- Views: rendu HTML

Cycle d'une requête:
1/ index.php (FrontController) reçoit la requête HTTP
2/ Le Router détermine le Controller
3/ Le Controller traite la logique et appelle Services
4/ Le / Les Repositories sont appelés
5/ Le Controller envoit les données à la View

----------------------------------------------------------------------------------------------------

Prérequis:

- PHP >= 8.1
- MySQL
- Composer

----------------------------------------------------------------------------------------------------

Installation:

1/ Cloner le projet:
    git clone https://github.com/ChrisAnger59/TomTroc.git
    cd TomTroc

2/ Installer les dépendances (autoload):
    composer install

3/ Configurer l'environnement: 
Renommer le fichier .env.example en .env (à la racine du projet)
Et modifier les valeurs de DB_HOST / DB_NAME / DB_USER / DB_PASS (ne rien mettre après le "=" si pas de mot de passe)

4/ Créer une BDD MySQL
Importer schema.sql dans le dossier /database/

----------------------------------------------------------------------------------------------------

Sécurité:

- Mots de passe hashés avec password_hash()
- Requêtes préparées via PDO (pas d'injection SQL)
- Validation des données utilisateur
- Protection des routes (authentification requise)
- Upload sécurisé:
    - Types autorisés (JPEG, JPG, PNG)
    - Taille limitée
    - Noms de fichiers uniques

----------------------------------------------------------------------------------------------------

Structure du projet:

/app
    /Controllers
    /Core
    /Models
    /Repositories
    /Services
    /Views
/config
/public
    /css
    /images
    /uploads
        /users
        /books
    /index.php
.env
