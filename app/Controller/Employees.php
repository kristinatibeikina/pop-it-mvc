<?php

namespace Controller;


use Src\View;
class Employees
{

    public function addendum(): string
    {
        return new View('employees.addendum');
    }


    public function counting(): string
    {
        return new View('employees.counting');
    }



}
