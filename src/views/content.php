<div class="container py-4">
    <h4 class="mb-3">記事画面</h4>
    <a href="../list.php">戻る</a>
    <a href="../logout.php">logout</a>
    <?php if ($post) : ?>
        <?php // 投稿の表示 ?>
        <h2><?php echo h($post->getTitle()) ?></h2>
        <p><?php echo nl2br(h($post->getContent())) ?></p>
        <p>Posted on: <?php echo h($post->getCreatedAt()) ?></p>
    <?php endif; ?>
    <form action="" method="post">
    </form>
</div>
