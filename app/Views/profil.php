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
                <p><img src="./images/book-logo.svg" alt="book-logo"><?= count($books) ?> livres</p>
            </div>
        </div>

        <div id="personal-info" class="flex-col">
            <form class="flex-col" method="POST" action="index.php?action=updatePersonalInfo">

                <p>Vos informations personnelles</p>

                <label>Adresse email</label>
                <input type="text" name="email" placeholder="<?= $user->getEmail() ?>">

                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••">

                <label>Pseudo</label>
                <input type="text" name="nickname" placeholder="<?= $user->getNickname() ?>">

                <button class="btn btn-outline">Enregistrer</button>
            </form>
        </div>
    </article>

    <article id="owned-books">
        <table>
            <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>DESCRIPTION</th>
                    <th>DISPONIBILITE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><img src="<?= $book->getCoverPicturePath() ?>"></td>
                        <td><?= $book->getTitle() ?></td>
                        <td><?= $book->getAuthor() ?></td>
                        <td><?= $book->getDescription(100) ?></td>
                        <td>
                            <?php if ($book->getAvailability() === 1): ?>
                                disponible
                            <?php else: ?>
                                non dispo.
                            <?php endif; ?>
                        </td>
                        <td><a href="">Editer</a> <a href="">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>