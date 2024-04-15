
<h1>Загрузка файла</h1>
<form method="post" enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="file">Выберите файл для загрузки:</label>
    <input type="file" name="file" id="file">
    <button type="submit">Загрузить</button>
</form>


