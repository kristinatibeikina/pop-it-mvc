<?php

namespace Controller;
use Src\Request;
use Model\Building;
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


}
