<?php
use PHPUnit\Framework\TestCase;
use Model\User;


class AdminTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        // Выбираем из БД пользователя с логином "0"


        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Admin())->signup($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем есть ли такой пользователь в базе данных
        $userExists = User::where('login', $userData['login'])->exists();
        $this->assertTrue($userExists);

        //Удаляем созданного пользователя из базы данных

    }


//Метод, возвращающий набор тестовых данных
    public function additionProvider(): array
    {
        return [
            ['GET', ['name'=>'','login' => '', 'password' => ''], '<h3></h3>'],
            //Проверка пустых полей
            ['POST', ['name'=>'','login' => '', 'password' => md5(time())], '<h3>{"name":["Поле name пусто","Поле name только кирилица"],"login":["Поле login пусто"],"password":["Поле password пусто","Поле password недостаточный размер (мин 9 симаолов)","Поле password только латиница и цифры"]}</h3>'],
            //Проверка на занятый логин
            ['POST', ['name'=>'Кристи','login' => '0', 'password' => md5(time())], '<h3>{"login":["Поле login пусто","Поле login должно быть уникально"]}</h3>'],
            //Создание пользователя
            ['POST', ['name'=>'Кристи','login' => md5(time()), 'password' => md5(time())], '<h3></h3>'],
        ];
    }

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '/xampp/htdocs';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }



}
