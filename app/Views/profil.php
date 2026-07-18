<?php 
    $error = App\Services\Utils::getErrorMessage();
?>

<?php if($error): ?>
            <p id="errorMessage"><?= $error ?></p>
<?php endif; ?>

<section id="profile-info-section" class="flex-col gap-2">
    <h2>Mon compte</h2>
    <article id="profile-info" class="flex">

        <div id="profile-resume" class="flex-col">
            <div class="flex-col">
                <img id="profile-picture" src="<?= htmlspecialchars($user->getProfilePicturePath()) ?>" alt="image profil utilisateur">
                <form action="index.php?action=uploadProfilePicture" method="POST" enctype="multipart/form-data">
    
                    <label for="photo">Modifier</label>
                    <input type="file" name="photo" id="photo" hidden>
                    <input type="submit" value="✔" class="upload-validator">

                </form>
            </div>
            <div class="border">

            </div>
            <div class="flex-col">
                <p class="owner-name"><?= htmlspecialchars($user->getNickname()) ?></p>
                <p class="since"><?= htmlspecialchars($user->getMembershipTime()) ?></p>
            </div>
            <div class="flex-col">
                <h3 class="mini-capital">BIBLIOTHEQUE</h3>
                <p><img src="./images/book-logo.svg" alt="book-logo"><?= count($books) ?> livres</p>
            </div>
        </div>

        <div id="personal-info" class="flex-col">
            <form class="flex-col" method="POST" action="index.php?action=updatePersonalInfo">

                <p>Vos informations personnelles</p>

                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Laisser vide pour ne pas changer">

                <label for="nickname">Pseudo</label>
                <input type="text" name="nickname" id="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>">

                <button class="btn btn-outline">Enregistrer</button>
            </form>
        </div>
    </article>

    <article id="owned-books" class="flex-col">
        <table>
            <thead>
                <tr>
                    <th class="mini-capital c1">PHOTO</th>
                    <th class="mini-capital">TITRE</th>
                    <th class="mini-capital">AUTEUR</th>
                    <th class="mini-capital">DESCRIPTION</th>
                    <th class="mini-capital">DISPONIBILITE</th>
                    <th class="mini-capital">ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php $index = 0; ?>
                <?php foreach ($books as $book): ?>
                    <tr class="<?= ($index % 2 === 0) ? 'paire' : 'impaire' ?>">
                        <td class="c1"><img src="<?= htmlspecialchars($book->getCoverPicturePath()) ?>" alt="Couverture livre"></td>
                        <td><?= htmlspecialchars($book->getTitle()) ?></td>
                        <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                        <td class="description"><?= htmlspecialchars($book->getDescription(100)) ?></td>
                        <td>
                            <?php if ($book->getAvailability() === 1): ?>
                                <span class="stock">disponible</span>
                            <?php else: ?>
                                <span class="out-stock">non dispo.</span>
                            <?php endif; ?>
                        </td>
                        <td><a href="index.php?action=updateBook&id=<?= $book->getId() ?>" class="edit-book">Editer</a> <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" class="delete-book">Supprimer</a></td>
                    </tr>
                <?php $index++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div id="add-book-link">
            <a href="" class="btn btn-primary">Ajouter un livre</a>
        </div>
    </article>
</section>