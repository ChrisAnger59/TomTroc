<section id="mail-box-section">
    <div class="messaging">

        <div class="conversations">

            <h1>Messagerie</h1>
            
                <?php foreach ($conversations as $conversation): ?>
                    <a href="index.php?action=messages&user=<?= $conversation->getOtherUser()->getId() ?>">
                        <div class="conversation-card">
                            <strong><?= htmlspecialchars($conversation->getOtherUser()->getNickname()) ?></strong><br>
                            <small><?= htmlspecialchars(substr($conversation->getContent(), 0, 30)) ?></small>
                        </div>
                    </a>
                <?php endforeach; ?>
        </div>



        <div class="chat">

                <div class="messages">

                    
                    <?php foreach ($messages as $message): ?>
                        <div class="message <?= $message->getSenderId() === $userId ? 'sent' : 'received' ?>">
                            <p><?= App\Services\Utils::convertDateToFrenchFormat($message->getCreatedAt()) ?></p>
                            <p><?= htmlspecialchars($message->getContent()) ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>

                <form method="POST" action="index.php?action=sendMessage" class="send-form">
                    <input type="hidden" name="receiver_id" value="<?= $otherUserId ?>">
                    <textarea name="content" required></textarea>
                    <button type="submit">Envoyer</button>
                    <?php if ($otherUserId): ?>
                        <a href="index.php?action=messages&user=<?= $otherUserId ?>">Refresh</a>
                    <?php endif; ?>
                </form>

        </div>

    </div>

</section>