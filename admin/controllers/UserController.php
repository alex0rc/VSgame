<?php
namespace admin\controllers;

use admin\models\User;

require_once __DIR__.'/../models/User.php';

class UserController{
    public function index() : void{
        $u = new User();
        $users = $u->getAllUsers();

        if($users != null){
            require __DIR__ . '/../views/users/list.php';
        }
    }

    public function store(User $user) : void{
        if($user == null){
            throw new \InvalidArgumentException('No se proporcionó un usuario');
        } else {
            $user->save();
            header('Location: ?controller=UserController&action=list');
        }
    }

    public function update(User $user) : void{
        if($user == null){
            throw new \InvalidArgumentException('No se proporcionó un usuario');
        } else {
            $user->save();
            header('Location: ?controller=UserController&action=list');
        }
    }

}