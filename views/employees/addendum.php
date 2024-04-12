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
        <h2 class="add_title_dv">Новые помещения</h2>
        <form method="post" class="form_add_room ">
            <select name="role" class="role">
                <option selected="selected">Здание</option>
                <option>Сотрудник</option>
                <option>Администратор</option>
            </select><br>
            <input type="text" name="title" placeholder="Название или номер помещения" class="input_password"><br>

            <fieldset class="building_now">
                <legend>Вид помещения</legend>
                <div>
                    <input type="checkbox" id="audit" name="interest" value="audit" />
                    <label for="coding">Аудитория</label>
                </div>
                <div>
                    <input type="checkbox" id="lab" name="interest" value="lab" />
                    <label for="lab">Лаборанская</label>
                </div>
            </fieldset>

            <input type="text" name="adres" placeholder="Площадь" class="input_password"><br>
            <input type="text" name="adres" placeholder="Кол-во посадочных мест" class="input_password"><br>
            <button class="btn">Отправить</button>
        </form>
    </div>

</div>