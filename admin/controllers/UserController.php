<?php
namespace admin\controllers;

use admin\models\User;
use admin\views\users;

require_once __DIR__.'/../models/User.php';

class UserController{
    public function index() : void{
        $u = new User();
        $users = $u->getAllUsers();

        if($users != null){
            
        }
    }
}