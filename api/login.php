<?php
namespace api;

use admin\models\User;
use admin\models\Database;

require_once '../../admin/models/User.php';
require_once '../../admin/models/Database.php';

session_start();

$db = Database::getInstance();
$con = $db->connect();

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$u = new User();
$user = $u->getByUsername($username);

if($user){
    if (password_verify($password, $user->getPassword())) {
        $_SESSION['user'] = $user;
        header('Location: ../views/show.php');
        exit;
    }else{
        echo "Error: Contraseña incorrecta";
    }
}else{
    echo "Error: Usuario no encontrado";
}

