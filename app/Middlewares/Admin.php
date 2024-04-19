<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class Admin
{


    public function handle(Request $request)
    {
        //Если пользователь не аутентифицирован, то перенаправляет на логин
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        //Если пользователь НЕ админ, то перенаправляем на главную страницу
        if (!Auth::checkRole()) {
            app()->route->redirect('/hello');
        }
    }
}
