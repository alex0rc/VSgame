<?php
namespace api;

use admin\models\User;
use admin\models\Database;

require_once '../../admin/models/User.php';
require_once '../../admin/models/Database.php';

$db = Database::getInstance();
$con = $db->connect();

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$user = new User()->getByUsername($username);

if($user){
    if($user->getPassword() == password_hash($password, PASSWORD_DEFAULT)){
        $_SESSION['user'] = $user;
        header('Location: ../views/show.php');
    }else{
        echo "Error: Contraseña incorrecta";
    }
}else{
    echo "Error: Usuario no encontrado";
}

