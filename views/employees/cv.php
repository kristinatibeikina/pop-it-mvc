<div class="counting">
    <div class="counting_bloc">


        <h2 class="add_title">Кол-во посадочных мест по зданию и названию помещения</h2>
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
                <h3>Выбирите удиторию</h3>
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
                <h2 class="add_title_dv">Кол-во посадочных мест: <?= $place; ?></h2>
            <?php endif; ?>
        </form>

    </div>
</div>