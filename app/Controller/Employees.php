<?php

namespace Controller;
use Src\Request;
use Model\Building;
use Model\Views;
use Src\View;
class Employees
{



    public function counting(): string
    {
        return new View('employees.counting');
    }


    public function addendum(Request $request): string
    {

        if ($request->method === 'POST' && Building::create($request->all())) {
            app()->route->redirect('/addendum');
        }

        return new View('employees.addendum');
    }

    public function building(): string
    {
        $buildings= Building::all();
        return new View('employees.building',['buildings'=>$buildings]);
    }

    public function views(Request $request): string
    {
        $views= Views::all();
        return new View('employees.building',['views'=>$views]);
    }


}
