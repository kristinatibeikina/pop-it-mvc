<?php

namespace Controller;

use Src\View;
class Admin
{
    public function signup(): string
    {
        return new View('admin.signup');
    }




}

