<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'minimum' => \Validators\MinimumValidator::class,
        'cyrillic' => \Validators\CyrillicValidator::class,
        'numeric' => \Validators\NumericValidator::class,
        'latin' => \Validators\LatinValidator::class,
    ],
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\Admin::class,
        'employees' => \Middlewares\Employees::class,
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,

    ],


];
