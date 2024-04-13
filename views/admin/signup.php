<h3><?= $message ?? ''; ?></h3>

<div class="create_user">
    <h1 class="title_login">Добавление</h1>
    <h2 class="add_title_dv">Новые сотрудники</h2>
    <form method="post" class="form_login">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="name" placeholder="Имя" class="input_login"><br>
        <input type="text" name="login" placeholder="Логин" class="input_password"><br>
        <input type="password" name="password" placeholder="Пароль" class="input_password"><br>
        <button class="btn">Отправить</button>
    </form>
</div>
