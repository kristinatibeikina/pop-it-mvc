<div class="counting">
    <div class="counting_bloc">


        <h2 class="add_title">Площадь аудиторий по зданию</h2>
        <form method="get" class="form_add">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <?php if(!$rooms):?>
                <h3>Выбирите здание</h3>
                <select name="building_id" class="role" id="buildingSelect">
                    <option selected disabled>Выберите здание</option>
                    <?php
                    $buildings = \Model\Building::all();
                    foreach ($buildings as $building): ?>
                        <option value="<?= $building->id; ?>"><?= $building->title; ?></option>
                    <?php endforeach; ?>
                </select><br>
                <button type="submit" class="btn">Дальше</button><br>
            <?php endif; ?>
            <?php if($rooms):?>
                <h3>Выбирите помещение</h3>
                <select name="room" class="role" id="roomSelect">
                    <option selected="selected">Название помещение</option>
                    <?php
                    foreach ($rooms as $room):?>
                        <option ><?= $room->title; ?></option>
                    <?php endforeach; ?>
                </select><br>


                <button type="submit" class="btn">Расчитать</button><br>
            <?php endif; ?>
            <?php if (isset($place)): ?>
                <h2 class="add_title_dv">Площадь аудитории: <?= $place; ?></h2>
            <?php endif; ?>

            <h2 class="add_title">Площадь аудиторий по учебному заведению</h2>
            <form method="get" class="form_add ">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

                <?php if (isset($square)): ?>
                    <h2 class="add_title_dv">Общая площадь аудиторий: <?= $square; ?></h2>
                <?php endif; ?>
        </form>

    </div>
</div>