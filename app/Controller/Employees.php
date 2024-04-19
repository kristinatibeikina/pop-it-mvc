<?php

namespace Controller;
use Src\Validator\Validator;
use Model\Image;
use Model\Room;
use Src\Request;
use Model\Building;
use Model\Views;
use Src\View;
error_reporting(0);

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
                'title' => ['unique:building,title', 'required','cyrillic'],
                'S'=>['required','numeric'],
                'count'=>['required','numeric'],
                'building_id'=>['required'],
                'view_id'=>['required'],
            ],
                [
                    'required' => 'field empty',
                    'unique' => 'Field must be unique',
                    'numeric' => 'Field none numeric',
                    'cyrillic' => 'Field none cyrillic',
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



    public function c(Request $request): string
    {
        // Площадь
        $place = 0;

        if ($request->method === 'GET') {

            // Получаем название выбранного здания
            if($buildingId = $request->get('building_id')){
                $rooms=Room::where('building_id',$buildingId)->where('view_id', '3') // Условие для выбора только аудиторий
                ->get();
                if ($request->method === 'GET') {
                    $r=Room::all();
                    foreach ($r as $room) {
                        $square += $room->S;
                    }

                }
                return new View('employees.counting', ['rooms' => $rooms, 'square' => $square]);

            }
            if($roomTitle = $request->get('room')){

                $place = Room::where('title',$roomTitle)->get();

                foreach ($place as $room) {
                    $p += $room->S;
                }
                $square = 0;

                if ($request->method === 'GET') {
                    $rooms=Room::all();
                    foreach ($rooms as $room) {
                        $square += $room->S;
                    }

                }

                return new View('employees.counting', ['place' => $p, 'square' => $square]);
            }
        }


        // Отображаем представление с площадью
        return new View('employees.counting', ['place' => $place]);
    }







    public function cv(Request $request): string
    {
        // Площадь
        $place = 0;

        if ($request->method === 'GET') {

            // Получаем название выбранного здания
            if($buildingTitle = $request->get('building_id')){
                $rooms=Room::where('building_id',$buildingTitle)->where('view_id', '3') // Условие для выбора только аудиторий
                ->get();
                return new View('employees.cv', ['rooms' => $rooms]);

            }
            if($roomTitle = $request->get('room')){

                        $place = Room::where('title',$roomTitle)->get();

                foreach ($place as $room) {
                    $p += $room->count;
                }
                    return new View('employees.cv', ['place' => $p]);
                }
        }


        // Отображаем представление с площадью
        return new View('employees.cv', ['place' => $place]);
    }



    public function search(Request $request): string
    {
        $message = null;
        $room = [];
        if ($request->get('search')) {
            // Получаем параметр поиска из запроса
            $search = $request->get('search');

            // Если есть параметр поиска, выполняем поиск
            if ($search) {
                // Выполняем поиск дисциплин по имени
                $room = Room::where('title', 'like', '%' . $search . '%')->get();

            }
            if ($room->isEmpty()) {
                $message = 'Помещения с таким названием отсутствуют';
            }

        } else{
            $room = Room::all();
        }

        return new View('employees.search', ['room' => $room, 'message' => $message ?? null]);
    }



}
