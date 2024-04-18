<?php
use PHPUnit\Framework\TestCase;
use Model\Room;


class EmployeesTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        // Выбираем из БД пользователя с логином "0"

        if ($userData['title'] === 'КТРМ') {
            // Создаем пользователя с незахешированным паролем 'proverka'
            Room::create([
                'title' => $userData['title']
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
        $result = (new \Controller\Employees())->room($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем есть ли такое помещение в базе данных
        $userExists = Room::where('title', $userData['title'])->exists();
        $this->assertTrue($userExists);

        //Удаляем созданное помещение из базы данных
        Room::where('title', $userData['title'])->delete();
    }


//Метод, возвращающий набор тестовых данных
    public function additionProvider(): array
    {
        return [
            ['GET', ['title'=>'','S' => '', 'count' => '','building_id' => '','view_id' => ''], '<h3></h3>'],

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
