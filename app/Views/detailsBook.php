<p id="nav-pre-section">
    <a href="index.php?action=allBooks">Nos livres</a> 
    > 
    <?= htmlspecialchars($book->getTitle()) ?>
</p>

<section id="section-details" class="flex gap-2">

    <div id="book-cover">
        <img src="<?= htmlspecialchars($book->getCoverPicturePath()) ?>">
    </div>

    <article id="book-article" class="flex-col">
        <div id="title-author" class="flex-col gap-1">
            <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
            <p>par <?= htmlspecialchars($book->getAuthor()) ?></p>
        </div>

        <span></span>

        <div class="flex-col gap-1" id="description">
            <h2 class="mini-capital">DESCRIPTION</h2>
            <p><?= htmlspecialchars($book->getDescription()) ?></p>
        </div>

        <div class="flex-col gap-1" id="owner-div">
            <h2 class="mini-capital">PROPRIETAIRE</h2>
            <a href="index.php?action=detailsUser&id=<?= $book->getUserId() ?>">
            <div>
                <img src="<?= htmlspecialchars($book->getUser()->getProfilePicturePath()) ?>"><p><?= htmlspecialchars($book->getUser()->getNickname()) ?></p>
            </div>
            </a>
        </div>
        <a href="index.php?action=messages&user=<?= $book->getUserId() ?>"><button class="btn btn-primary">Envoyer un message</button></a>
    </article>
</section>