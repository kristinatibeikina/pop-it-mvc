<div class="hello">
    <div class="hello_bloc">
        <h1 class="hello_title">Личный кабинет</h1>
        <h3><?= app()->auth::user()->name ?></h3>

        <form  method="post" enctype="multipart/form-data">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="file" name="image" ><br>
            <button type="submit" class="btn btn_img">Загрузить изображение </button>
        </form>
        <?php if ($images->isNotEmpty()): ?>
            <?php foreach ($images as $image): ?>
                <img src="/pop-it-mvc/public/image/<?= $image->name ?>" class="image" alt="Изображение">
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
