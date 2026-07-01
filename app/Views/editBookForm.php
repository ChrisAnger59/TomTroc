<section id="book-edit-form" class="flex-col">

    <div id="header-section" class="flex-col gap-1">
        <a id="backlink" href=""><- retour</a>
        <h1>Modifier les informations</h1>
    </div>

    <article class="flex gap-2">
        <div id="book-img" class="flex-col gap-1">
            <label>Photo</label>
            <img src="<?= $book->getCoverPicturePath() ?>">
            <a href="">Modifier la photo</a>
        </div>

        <div id="book-info" class="flex-col gap-1">

            <label type="hidden"></label>

            <form class="flex-col" method="POST" action="index.php?action=updateBookInfo&id=<?= $book->getId() ?>">

                <label>Titre</label>
                <input type="text" name="title" placeholder="<?= $book->getTitle() ?>">

                <label>Auteur</label>
                <input type="text" name="author" placeholder="<?= $book->getAuthor() ?>">

                <label>Commentaire</label>
                <textarea id="description-input" rows="20" name="description" placeholder="<?= $book->getDescription() ?>"></textarea>

                <label>Disponibilité</label>
                <select name="availability" id="status">
                    <option value="1" <?= $book->getAvailability() === 1 ? 'selected' : '' ?>>
                        Disponible
                    </option>

                    <option value=0 <?= $book->getAvailability() === 0 ? 'selected' : '' ?>>
                        Non Disponible
                    </option>
                </select>

                <button class="btn btn-primary">Valider</button>
            </form>

        </div>
    </article>
</section>