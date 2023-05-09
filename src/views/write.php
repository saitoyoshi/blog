<div class="container py-4">
    <h4 class="mb-3">記事を書く</h4>
    <a href="../logout.php">logout</a>
    <a href="../list.php">戻る</a>

    <form action="" method="post" onsubmit="return confirmSubmit('記事を保存していいですか？')(event);">

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php if (isset($_POST['title'])) : ?><?php echo h($_POST['title']) ?><?php endif; ?>">
            <p class="mt-3 text-danger"><?php if (isset($errors['title'])) : ?><?php echo h($errors['title']) ?><?php endif; ?></p>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">本文</label>
            <textarea name="content" id="content" cols="30" rows="10" placeholder="ここに本文" class="form-control"><?php if (isset($_POST['content'])) : ?><?php echo h($_POST['content']) ?><?php endif; ?></textarea>
            <p class="mt-3 text-danger"><?php if (isset($errors['content'])) : ?><?php echo h($errors['content']) ?><?php endif; ?></p>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">タグ (カンマで区切って複数のタグを入力)</label>
            <input type="text" class="form-control" name="tags" id="tags">
        </div>
        <button type="submit" class="btn btn-info">記事を投稿</button>
    </form>
</div>
