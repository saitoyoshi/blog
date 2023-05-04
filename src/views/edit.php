<div class="container py-4">
    <h4 class="mb-3">編集画面</h4>
    <a href="../logout.php">logout</a>
    <a href="../list.php">戻る</a>

    <?php if ($post) : ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo h($post->getTitle()) ?>">
        </div>
        <div class="mb-3">
        <label for="content" class="form-label">本文</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo h($post->getContent()) ?></textarea>
        </div>
        <input type="hidden" name="post_id" value="<?php echo $post->getId() ?>">
        <button type="submit" class="btn btn-info">更新</button>
    </form>
    <?php endif; ?>
