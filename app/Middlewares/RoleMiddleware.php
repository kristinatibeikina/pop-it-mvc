<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не админ, то перенаправляет на главную страницу
        if (!Auth::check()) {
            app()->route->redirect('/hello');
        }
    }
}
