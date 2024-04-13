<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/pop-it-mvc/public/css/style.css">

    <title>Pop it MVC</title>
</head>
<body>
<header>
    <nav class="nav">
        <div class="nav_bloc">
            <?php
            if (!app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/login') ?>" class="a_footer">Вход</a>
            <?php
            else:
                if (app()->auth::checkRole()):
            ?>
            <a href="<?= app()->route->getUrl('/signup') ?>" class="a_footer">Добавление</a>
            <a href="<?= app()->route->getUrl('/hello') ?>" class="a_footer">Личный кабинет</a>
            <a href="<?= app()->route->getUrl('/logout') ?>" class="a_footer">Выход</a>


                <?php
                else:
                    ?>
                    <a href="<?= app()->route->getUrl('/addendum') ?>" class="a_footer">Дополнение</a>
                    <a href="<?= app()->route->getUrl('/counting') ?>" class="a_footer">Подсчет</a>
                    <a href="<?= app()->route->getUrl('/hello') ?>" class="a_footer">Личный кабинет</a>
                    <a href="<?= app()->route->getUrl('/logout') ?>" class="a_footer">Выход</a>
            <?php
            endif;
            ?>
            <?php
            endif;
            ?>
        </div>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>