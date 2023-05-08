<div class="container py-4">
    <h4 class="mb-3">投稿一覧画面</h4>
    <a href="../logout.php">logout</a>
    <a href="../write.php" class="btn btn-success">記事を書く</a>
    <hr>
    <?php foreach ($posts as $post) : ?>
        <div class="card mb-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><a class="text-decoration-none text-dark" href="<?php echo "content.php?id=" . $post->getId() ?>"><?php echo h($post->getTitle()) ?></a></h5>
                <p class="card-text"><a class="text-decoration-none text-secondary" href="<?php echo "content.php?id=" . $post->getId() ?>"><?php $content_first_line = strtok($post->getContent(), "\n") ?><?php echo h($content_first_line) ?></a></p>
                <p>タグ</p>
                <?php $tagNames = getTagsByPostId($post->getId()); ?>
                <?php foreach ($tagNames as $tagName) : ?>
                    <?php echo "<a href=\"tag.php?tag=" . urlencode($tagName) . "\">" . h($tagName) . "</a>" ?>
                <?php endforeach; ?>
                <p>Posted by: <?php echo h($post->getUsername()) . ' on ' . h($post->getCreatedAt()) ?></p>
                <?php if ($_SESSION['user']->getId() == $post->getUserId()) : ?>

                    <form action="delete_post.php" method="post" onsubmit="return confirm('本当に記事を削除してもいいですか？')">
                        <input type="hidden" name="post_id" value="<?php echo h($post->getId()) ?>">
                        <a href="../edit.php?id=<?php echo h($post->getId()) ?>" class="btn btn-info">編集</a>
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>

                <?php endif; ?>
                </div>
            </div>
    <?php endforeach; ?>

</div>

</div>
