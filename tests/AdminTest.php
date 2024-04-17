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

        if ($userData['login'] === '0') {
            // Создаем пользователя с незахешированным паролем 'proverka'
            User::create([
                'login' => $userData['login'],
                'password' => md5('proverka')
            ]);
        }

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
        User::where('login', $userData['login'])->delete();
    }


//Метод, возвращающий набор тестовых данных
    public function additionProvider(): array
    {
        return [
            ['GET', ['name'=>'','login' => '', 'password' => ''], '<h3></h3>'],
            ['POST', ['name'=>'','login' => '', 'password' => ''], '<h3>{"name":["Поле name пусто"],"login":["Поле login пусто"],"password":["Поле password пусто","Поле password недостаточный размер (мин 9 симаолов)","Поле password только латиница и цифры"]}</h3>'],
            ['POST', ['name'=>'Кристи','login' => '0', 'password' => 'hbcnb1safd23456'], '<h3>{"login":["Поле login пусто","Поле login должно быть уникально"]}</h3>'],
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
