<?php 
    $error = App\Services\Utils::getErrorMessage();
?>

<?php if($error): ?>
            <p id="errorMessage"><?= $error ?></p>
<?php endif; ?>

<section class="flex" id="section-log">

    <article class="article-log-form">

        <div class="flex-col gap-3">
            <h1><?= $titre ?></h1>

            <form action="index.php?action=<?= $action ?>" method="POST">

                <?php if ($signin): ?>
                <label>Pseudo</label>
                <input type="text" id="nickname" name="nickname">
                <?php endif; ?>

                <label>Adresse email</label>
                <input type="text" id="email" name="email">

                <label>Mot de passe</label>
                <input type="text" id="password" name="password">

                <button type="submit" class="btn btn-primary"><?= $buttonText ?></button>

                <p><?= $mentionLink ?> <a href="<?= $link ?>"><?= $textLink ?></a></p>
            </form>
        </div>
    </article>


    <article id="article-img">
        <img src="./images/log-img.jpg" alt="Illustration bibliotheque">
    </article>

</section>