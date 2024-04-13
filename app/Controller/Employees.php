<?php

namespace Controller;
use Model\Room;
use Src\Request;
use Model\Building;
use Model\Views;
use Src\View;

use Src\Validator\Validator;
class Employees
{



    public function counting(): string
    {
        return new View('employees.counting');
    }

    //Создание названий зданий
    public function addendum(Request $request): string
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(),[
                'title' => ['unique:building,title'],
            ],
            ['unique' =>'Поле Название должно быть уникальное значение']);

            if($validator->fails()){
                return new View('employees.addendum',
                ['message' => json_encode($validator->errors(),JSON_FORCE_OBJECT)]);
            }

            if (Building::create($request->all())) {
                app()->route->redirect('/addendum');
            }
        }



        return new View('employees.addendum');
    }


    //Вывод всех названий зданий из БД
    public function building(): string
    {
        $buildings= Building::all();
        return new View('employees.room',['buildings'=>$buildings]);




    }

    //Вывод всех видов помещений из БД
    public function views(Request $request): string
    {
        $views= Views::all();
        return new View('employees.room',['views'=>$views]);
    }


    public function room(Request $request): string
    {
        // Cохранение данных в базу данных
        if ($request->method === 'POST') {
            // Пример сохранения данных помещения в базу данных
            if (Room::create($request->all())) {
                app()->route->redirect('/room');
            }

            // После сохранения данных можно перенаправить пользователя на другую страницу
            app()->route->redirect('/room');
        }


        // Отображение представления
        return new View('employees.room');

    }

}
