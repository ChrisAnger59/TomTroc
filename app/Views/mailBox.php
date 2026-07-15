<?php 
    $error = App\Services\Utils::getErrorMessage();
?>

<?php if($error): ?>
            <p id="errorMessage"><?= $error ?></p>
<?php endif; ?>

<section id="mail-box-section">
    <div class="messaging">

        <div class="conversations">

            <h1>Messagerie</h1>
            
                <?php foreach ($conversations as $conversation): ?>

                    <?php 
                        $convUserId = $conversation->getOtherUser()->getId();
                        $isActive = ($convUserId == $otherUserId);
                    ?>

                    <a href="index.php?action=messages&user=<?= $convUserId ?>">
                        <div class="conversation-card <?= $isActive ? 'active' : '' ?>">
                            <img src="<?= $conversation->getOtherUser()->getProfilePicturePath() ?>" alt="Image de profil utilisateur">
                            <div class="conv-col">
                                <div class="conv-row">
                                    <p><?= htmlspecialchars($conversation->getOtherUser()->getNickname()) ?></p>
                                    <p><?= App\Services\Utils::convertDateFormatHour($conversation->getCreatedAt()) ?></p>
                                </div>
                                <small><?= htmlspecialchars(substr($conversation->getContent(), 0, 30)) ?></small>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
        </div>



        <div class="chat">

            <?php if ($messages): ?>
            <div id="messages-header">
                <img src="<?= $otherUser->getProfilePicturePath() ?>" alt="image de profil utilisateur">
                <h2><?= $otherUser->getNickname() ?></h2>
            </div>
            <?php endif; ?>

                <div class="messages">

                    
                    <?php foreach ($messages as $message): ?>

                        <div class="<?= $message->getSenderId() === $userId ? 'sent' : 'received' ?>">
                            <div class="subMessage">
                                <?php if ($message->getSenderId() === $otherUserId): ?>
                                    <img src="<?= $otherUser->getProfilePicturePath() ?>" alt="image de profil utilisateur">
                                <?php endif; ?>
                                <p><?= App\Services\Utils::convertDateFormat($message->getCreatedAt()) ?></p>
                            </div>
                            
                            <p class="message"><?= htmlspecialchars($message->getContent()) ?></p>
                        </div>

                    <?php endforeach; ?>

                </div>
                
                <?php if ($otherUserId): ?>

                <form method="POST" action="index.php?action=sendMessage" class="send-form">
                    <input type="hidden" name="receiver_id" value="<?= $otherUserId ?>">
                    <textarea name="content" placeholder="Tapez votre message ici" required></textarea>
                    <button type="submit">Envoyer</button>
                    <?php if ($otherUserId): ?>
                        <a href="index.php?action=messages&user=<?= $otherUserId ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 4v6h-6"></path>
                                <path d="M1 20v-6h6"></path>
                                <path d="M3.51 9a9 9 0 0114.13-3.36L23 10M1 14l5.37 4.36A9 9 0 0020.49 15"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </form>

                <?php else: ?>

                    <div class="no-conversation">
                        <p>Sélectionnez une conversation pour envoyer un message</p>
                    </div>
                
                <?php endif; ?>

        </div>

    </div>

</section>