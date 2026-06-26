<section id="profile-info-section">
    <h2>Mon compte</h2>
    <article id="profile-info" class="flex">

        <div id="profile-resume" class="flex-col">
            <div class="flex-col">
                <img id="profile-picture" src="<?= $user->getProfilePicturePath() ?>">
                <a href="">Modifier</a>
            </div>
            <div class="flex-col">
                <p><?= $user->getNickname() ?></p>
                <p>Membre depuis :</p>
            </div>
            <div class="flex-col">
                <h3 class="mini-capital">BIBLIOTHEQUE</h3>
                <p><img src="./images/book-logo.svg" alt="book-logo">3 livres</p>
            </div>
        </div>

        <div id="personal-info" class="flex-col">
            <form class="flex-col">

                <p>Vos informations personnelles</p>

                <label>Adresse email</label>
                <input type="text" value="<?= $user->getEmail() ?>">

                <label>Mot de passe</label>
                <input type="password" value="000000">

                <label>Pseudo</label>
                <input type="text" value="<?= $user->getNickname() ?>">

                <button class="btn btn-outline">Enregistrer</button>
            </form>
        </div>
    </article>

    <article id="owned-books">

    </article>
</section>