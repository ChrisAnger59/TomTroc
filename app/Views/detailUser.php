<section id="public-profile" class="flex gap-3">
    <article id="info" class="flex">
        <div id="info-resume" class="flex-col">

            <div class="flex-col">
                <img id="public-pp" src="<?= $user->getProfilePicturePath() ?>">
            </div>

            <div class="border">
            </div>

            <div class="flex-col">
                <p class="owner-name"><?= $user->getNickname() ?></p>
                <p class="since"><?= $user->getMembershipTime() ?></p>
            </div>

            <div class="flex-col">
                <h3 class="mini-capital">BIBLIOTHEQUE</h3>
                <p><img src="./images/book-logo.svg" alt="book-logo"><?= count($books) ?> livres</p>
            </div>

            <button class="btn btn-outline">Ecrire un message</button>

        </div>
    </article>

    <article id="books" class="flex">
        <table>
            <thead>
                <tr>
                    <th class="mini-capital c1">PHOTO</th>
                    <th class="mini-capital">TITRE</th>
                    <th class="mini-capital">AUTEUR</th>
                    <th class="mini-capital">DESCRIPTION</th>
                </tr>
            </thead>

            <tbody>
                <?php $index = 0; ?>
                <?php foreach ($books as $book): ?>
                    <tr class="<?= ($index % 2 === 0) ? 'paire' : 'impaire' ?>">
                        <td class="c1"><img src="<?= $book->getCoverPicturePath() ?>"></td>
                        <td><?= $book->getTitle() ?></td>
                        <td><?= $book->getAuthor() ?></td>
                        <td class="description"><?= $book->getDescription(100) ?></td>
                    </tr>
                <?php $index++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>