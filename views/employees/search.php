<div class="add">
    <div class="add_bloc">
        <h1 class="add_title">Комнаты</h1>
        <form method="get" class="form_search">
            <input class="input_password" type="text" name="search" placeholder="Поиск...">
            <button class="btn" type="submit">Искать</button>
            <button class="btn"><a class="a_search" href="<?php app()->route->getUrl('/search'); ?>">Сбросить</a></button>
        </form>
        <ul class="discipline_list">
            <span class='search_response'><?= $message ?? ''; ?></span>
            <?php foreach ($room as $room_title) : ?>
                <span class='search_response'>Помещение: <?php echo $room_title->title; ?></span><br>
               <span class='search_response'>Кол-во посадочных мест: <?php echo $room_title->count; ?></span><br>
                <span class='search_response'>Площадь помещения: <?php echo $room_title->S; ?></span><br>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
