<h3><?= $message ?? ''; ?></h3><br>
<div class="add">
    <div class="add_bloc">
        <h1 class="add_title">Добавление</h1>
        <h2 class="add_title_dv">Новые здания</h2>
        <form method="post" class="form_add ">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="title" placeholder="Название" class="input_login"><br>
            <input type="text" name="address" placeholder="Адрес" class="input_password"><br>
            <button class="btn">Отправить</button>
        </form>

    </div>

</div>