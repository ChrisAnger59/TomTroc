<section>
    <h1>Mon Profil</h1>
    <p>Peudo: <?= $user->getNickname() ?></p><br>
    <p>Email: <?= $user->getEmail() ?></p><br>
    <p>Mot de passe (hashé): <?= $user->getPassword() ?></p>
</section>