<section id="book-edit-form" class="flex-col">

    <div id="header-section" class="flex-col gap-1">
        <a id="backlink" href=""><- retour</a>
        <h1>Modifier les informations</h1>
    </div>

    <article class="flex gap-2">
        <div id="book-img" class="flex-col gap-1">
            <label>Photo</label>
            <img src="<?= htmlspecialchars($book->getCoverPicturePath()) ?>">
            <form action="index.php?action=uploadBookPicture&id=<?= $book->getId() ?>" method="POST" enctype="multipart/form-data">
                
                <label for="bookPicture">Modifier la photo</label>
                <input type="file" name="bookPicture" id="bookPicture" hidden>
                <input type="submit" value="✔" id="upload-validator">

            </form>
        </div>

        <div id="book-info" class="flex-col gap-1">

            <label type="hidden"></label>

            <form class="flex-col" method="POST" action="index.php?action=updateBookInfo&id=<?= $book->getId() ?>">

                <label>Titre</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>">

                <label>Auteur</label>
                <input type="text" name="author" value="<?= htmlspecialchars($book->getAuthor()) ?>">

                <label>Commentaire</label>
                <textarea id="description-input" rows="20" name="description"><?= htmlspecialchars($book->getDescription()) ?></textarea>

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