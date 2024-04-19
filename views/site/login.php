<div class="login_bloc">
    <div class="login_litl_bloc">
        <h2 class="title_login">Авторизация</h2>
        <h3><?= $message ?? ''; ?></h3>

        <h3><?= app()->auth->user()->name ?? ''; ?></h3>
        <?php if (!app()->auth::check()): ?>
            <form method="post" class="form_login">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input type="text" name="login" placeholder="Логин" class="input_login"><br>
                <input type="password" name="password" placeholder="Пароль" class="input_password"><br>
                <button class="btn">Войти</button>
            </form>
        <?php endif; ?>
    </div>
</div>
