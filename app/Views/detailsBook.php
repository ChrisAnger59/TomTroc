<p id="nav-pre-section">
    <a href="index.php?action=allBooks">Nos livres</a> 
    > 
    <?= $book->getTitle() ?>
</p>

<section id="section-details" class="flex gap-2">

    <div id="book-cover">
        <img src="<?= $book->getImage() ?>">
    </div>

    <article id="book-article" class="flex-col">
        <div id="title-author" class="flex-col gap-1">
            <h1><?= $book->getTitle() ?></h1>
            <p>par <?= $book->getAuthor() ?></p>
        </div>

        <span></span>

        <div class="flex-col gap-1" id="description">
            <h2>DESCRIPTION</h2>
            <p><?= nl2br($book->getDescription()) ?></p>
        </div>

        <div class="flex-col gap-1">
            <h2>PROPRIETAIRE</h2>
            <div>
                <img src=""><p><?= $book->getOwner() ?></p>
            </div>
        </div>

        <button class="btn btn-primary">Envoyer un message</button>
    </article>
</section>