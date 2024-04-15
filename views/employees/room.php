<h3><?= $message ?? ''; ?></h3><br>
<div class="add">
    <div class="add_bloc">
        <h2 class="add_title">Новые помещения</h2>
        <form method="post" class="form_add_room ">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="title" placeholder="Название или номер помещения" class="input_password"><br>
            <input type="number" name="S" placeholder="Площадь" class="input_password"><br>
            <input type="number" name="count" placeholder="Кол-во посадочных мест" class="input_password"><br>
            <select name="building_id" class="role">
                <option selected="selected">Выберите здание</option>
                <?php
                $buildings = \Model\Building::all();
                foreach ($buildings as $building): ?>
                    <option value="<?= $building->id; ?>"><?= $building->title; ?></option>
                <?php endforeach; ?>
            </select>


            <select name="view_id" class="role">
                <option selected="selected">Вид помещения</option>
                <?php
                $views = \Model\Views::all();
                foreach ($views as $view):?>
                    <option value="<?= $view->id; ?>"><?= $view->title; ?></option>
                <?php endforeach; ?>
            </select><br>
            <button class="btn">Отправить</button>
        </form>
    </div>

</div>