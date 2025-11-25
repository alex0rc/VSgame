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

    public function store() : void{
        $u = new User();
        $u->setUserName($_POST['username'] ?? null);
        $u->setEmail($_POST['email'] ?? null);
        $u->setPassword($_POST['password'] ?? null);
        $u->setRole($_POST['role'] ?? null);

        $u->save();

        header('Location: ?controller=user&action=index');
        exit;
    }

    public function update() : void{
        $id = $_POST['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $u = new User($id);
        $u->setUserName($_POST['username'] ?? null);
        $u->setEmail($_POST['email'] ?? null);
        $u->setPassword($_POST['password'] ?? null);
        $u->setRole($_POST['role'] ?? null);

        $u->save();

        header('Location: ?controller=user&action=index');
        exit;
    }

}