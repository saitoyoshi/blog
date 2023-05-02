<div class="container py-4">
    <h4 class="mb-3">登録画面</h4>
    <form action="" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" name="name" id="name" value="<?php echo h($_POST['name']) ?>" class="form-control">
            <p class="mt-3 text-danger"><?php if (isset($errors['name'])): ?><?php echo h($errors['name']) ?><?php endif; ?></p>

        </div>
        <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <input type="email" name="email" id="email" value="<?php echo h($_POST['email']) ?>" class="form-control">
        <p class="mt-3 text-danger"><?php if (isset($errors['email'])): ?><?php echo h($errors['email']) ?><?php endif; ?></p>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">パスワード</label>
        <input type="password" name="password" id="password" value="" class="form-control">
        <p class="mt-3 text-danger"><?php if (isset($errors['password'])): ?><?php echo h($errors['password']) ?><?php endif; ?></p>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
