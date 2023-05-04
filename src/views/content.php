<div class="container py-4">
    <h4 class="mb-3">記事画面</h4>
    <a href="../list.php">戻る</a>
    <a href="../logout.php">logout</a>
    <?php
    if ($post) {
        // 投稿の表示
        echo '<h2>' . h($post->getTitle()) . '</h2>';
        echo '<p>' . nl2br(h($post->getContent())) . '</p>';
        echo '<p>Posted on: ' . h($post->getCreatedAt()) . '</p>';
    }
    ?>
    <form action="" method="post">
    </form>
</div>
