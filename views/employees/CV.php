<div class="counting">
    <div class="counting_bloc">
        <h1 class="add_title">Подсчет</h1>
        <h2 class="add_title_dv">Кол-во посадочных мест по зданиям</h2>
        <form method="post" class="form_add ">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="building" class="role">
                <option selected="selected">Здание</option>
                <?php
                $buildins = \Model\Building::all();
                foreach ($buildins as $building){
                    echo "<option> $building->title </option>";
                }
                ?>
            </select><br>
            <button class="btn">Расчитать</button><br>
            <input type="text" name="title" placeholder="Колличество" class="input_login response"><br>

        </form>
        <h2 class="add_title_dv">Площадь аудиторий по зданиям</h2>
        <form method="post" class="form_add ">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="building" class="role">
                <option selected="selected">Здание</option>
                <?php
                $buildins = \Model\Building::all();
                foreach ($buildins as $building){
                    echo "<option> $building->title </option>";
                }
                ?>
            </select><br>
            <button class="btn">Рассчитаь</button><br>
            <input type="text" name="title" placeholder="Колличество" class="input_login response"><br>
        </form>

        <h2 class="add_title_dv">Площадь аудиторий по учебному заведению</h2>






        <form method="get" action="/counting" class="form_add">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="building_id" class="role">
                <option selected disabled>Выберите здание</option>
                <?php
                $buildings = \Model\Building::all();
                foreach ($buildings as $building): ?>
                    <option ><?= $building->title; ?></option>
                <?php endforeach; ?>
            </select><br>
            <button type="submit" class="btn">Расчитать</button><br>
            <?php if (isset($totalArea)): ?>
                <h2 class="add_title_dv">Общая площадь аудиторий: <?= $totalArea; ?></h2>
            <?php endif; ?>
            <input type="text" name="title" placeholder="Колличество" class="input_login response"><br>
        </form>

    </div>
</div>