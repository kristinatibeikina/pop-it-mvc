<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class Employees
{
    public function handle(Request $request)
    {
        //Если пользователь не аутентифицирован, то перенаправляет на логин
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        // Если пользователь является администратором, перенаправить на другую страницу или выдать ошибку
        if (Auth::checkRole()) {
            app()->route->redirect('/hello'); // или '/403' для страницы с ошибкой доступа
        }
    }
}