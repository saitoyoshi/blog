<div class="container py-4">
    <h4 class="mb-3">ログイン画面</h4>
    <?php if (isset($_SESSION['msg'])) : ?>
        <p class="text-danger mt-3"><?php echo h($_SESSION['msg']) ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="msg" class="form-label">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php if (isset($_POST['email'])) : ?><?php echo h($_POST['email']) ?><?php endif; ?>">
            <?php if (isset($_SESSION['errors']['email'])) : ?>
                <p class="text-danger mt-3"><?php echo h($_SESSION['errors']['email']) ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control">
            <?php if (isset($_SESSION['errors']['password'])) : ?>
                <p class="text-danger mt-3"><?php echo h($_SESSION['errors']['password']) ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">ログイン</button>
    </form>
</div>
