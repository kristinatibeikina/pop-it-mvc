<div class="counting">
    <div class="counting_bloc">


        <h2 class="add_title_dv">Кол-во посадочных мест по зданию и названию помещению</h2>
        <form method="get" class="form_add">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="building_id" class="role" id="buildingSelect">
                <option selected disabled>Выберите здание</option>
                <?php
                $buildings = \Model\Building::all();
                foreach ($buildings as $building): ?>
                    <option ><?= $building->title; ?></option>
                <?php endforeach; ?>
            </select><br>

            <select name="room" class="role" id="roomSelect">
                <option selected="selected">Название помещения</option>
                <?php
                $rooms = \Model\Room::all();
                foreach ($rooms as $room):?>
                    <option ><?= $room->title; ?></option>
                <?php endforeach; ?>
            </select><br>


            <button type="submit" class="btn">Расчитать</button><br>
            <?php if (isset($place)): ?>
                <h2 class="add_title_dv">Общая площадь аудиторий: <?= $place; ?></h2>
            <?php endif; ?>
        </form>

    </div>
</div>