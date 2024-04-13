<div class="counting">
    <div class="counting_bloc">


        <h2 class="add_title_dv">Площадь аудиторий по зданиям</h2>
            <form method="get" class="form_add">
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
        </form>


        <h2 class="add_title_dv">Площадь аудиторий по учебному заведению</h2>
        <form method="get" class="form_add ">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

            <?php if (isset($square)): ?>
                <h2 class="add_title_dv">Общая площадь аудиторий: <?= $square; ?></h2>
            <?php endif; ?>
        </form>
    </div>
</div>