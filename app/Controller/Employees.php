<?php

namespace Controller;
use Src\Validator\Validator;

use Model\Room;
use Src\Request;
use Model\Building;
use Model\Views;
use Src\View;


class Employees
{



    //Создание названий зданий
    public function addendum(Request $request): string
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(),[
                'title' => ['unique:building,title', 'required','cyrillic'],
                'address'=>['required']
            ],
                [
                    'required' => 'field empty',
                    'unique' => 'Field :the field must be unique',
                    'cyrillic' => 'Field none cyrillic',
                ]);


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
        //Cохранение данных в базу данных
        if($request->method === 'POST'){
            $validator = new Validator($request->all(),[
                'title' => ['unique:building,title', 'required'],
                'S'=>['required'],
                'count'=>['required'],
                'building_id'=>['required'],
                'view_id'=>['required'],
            ],
                [
                    'required' => 'empty',
                    'unique' => 'Field must be unique',
                ]);


            if($validator->fails()){
                return new View('employees.room',
                    ['message' => json_encode($validator->errors(),JSON_FORCE_OBJECT)]);
            }
            if (Room::create($request->all())) {
                app()->route->redirect('/room');
            }

            // После сохранения данных можно перенаправить пользователя на другую страницу
            app()->route->redirect('/room');
        }


        // Отображение представления
        return new View('employees.room');

    }


    public function counting(Request $request): string
    {
        // Площадь
        $totalArea = 0;

        if ($request->method === 'GET') {
            // Получаем название выбранного здания
            $buildingTitle = $request->get('building_id');

            // Находим соответствующий building_id
            $building = Building::where('title', $buildingTitle)->first();

            // Если здание найдено, ищем все аудитории, относящиеся к этому зданию
            if ($building) {
                $rooms = Room::where('building_id', $building->id)
                    ->where('view_id', '3') // Условие для выбора только аудиторий
                    ->get();

                // Вычисляем площадь аудиторий
                foreach ($rooms as $room) {
                    $totalArea += $room->S;
                }
            }
        }
        $square = 0;

        if ($request->method === 'GET') {
            $rooms=Room::all();
            foreach ($rooms as $room) {
                $square += $room->S;
            }

        }

        // Отображаем представление с площадью
        return new View('employees.counting', ['totalArea' => $totalArea, 'square' => $square]);
    }



    public function cv(Request $request): string
    {
        // Площадь
        $place = 0;
        if ($request->method === 'GET') {


            // Получаем название выбранного здания
            $buildingTitle = $request->get('building_id');


            $roomTitle = $request->get('room');

            // Находим соответствующий building_id
            $building = Building::where('title', $buildingTitle)->first();

            // Если здание найдено, ищем все аудитории, относящиеся к этому зданию
            if ($building) {
                $rooms = Room::where('building_id', $building->id)
                    ->where('title', $roomTitle) // Условие для выбора только аудиторий
                    ->get();

                // Вычисляем кол-во посадочных мест
                foreach ($rooms as $room) {
                    $place += $room->count;
                }
            }
        }


        // Отображаем представление с площадью
        return new View('employees.cv', ['place' => $place, 'rooms' => $rooms]);
    }




}
