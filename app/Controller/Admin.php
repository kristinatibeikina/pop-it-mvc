<?php
namespace Controller;
use Validator\Validator;
use Src\Request;
use Model\User;
use Src\View;
class Admin
{

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required', 'minimum','cyrillic'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required','minimum','latin']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'minimum'=>'Поле :field недостаточный размер (мин 9 симаолов)',
                'latin'=>'Поле :field только латиница и цифры',
                'cyrillic' => 'Поле :field только кирилица',
            ]);

            if($validator->fails()){


                return new View('admin.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

            }

            if (User::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }
        return new View('admin.signup');
    }


}




