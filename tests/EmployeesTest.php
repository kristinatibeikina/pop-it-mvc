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
        // Выбираем из БД помещение с названием "КТРМ"

        if ($userData['title'] === 'КТР') {
            // Создаем поьещение с названием 'КТРМ'
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
                //Негативные тесты
            //Проверка на занятый title
            ['POST', ['title'=>'ТГУ','S' => '12', 'count' => '12','building_id' => '7','view_id' => '2'], '<h3>{"title":{"0":"Field must be unique"}}</h3>'],
            //Проверка на кирилицу
            ['POST', ['title'=>'TGU','S' => '12', 'count' => '12','building_id' => '14','view_id' => '3'], '<h3>{"title":{"0":"Field none cyrillic"}}</h3>'],
            //Пустые поля
            ['POST', ['title'=>'','S' => '', 'count' => '','building_id' => '7','view_id' => '2'], '<h3>{"title":{"0":"Field must be unique","1":"field empty","2":"Field none cyrillic"},"S":{"0":"field empty","1":"Field none numeric"},"count":{"0":"field empty","1":"Field none numeric"}}</h3>'],
            //Проверка когда не введены S и count
            ['POST', ['title'=>'ТРУМ','S' => '', 'count' => '','building_id' => '14','view_id' => '2'], '<h3>{"S":{"0":"field empty","1":"Field none numeric"},"count":{"0":"field empty","1":"Field none numeric"}}</h3>'],
                //Позитивные тест
            ['POST', ['title'=>'КТРМ','S' => '12', 'count' => '12','building_id' => '7','view_id' => '2'], '<h3></h3>'],
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
