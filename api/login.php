<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../admin/models/User.php';
require_once __DIR__ . '/../admin/models/Database.php';

use admin\models\User;

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error_login'] = "Acceso denegado";
    header("Location: ". BASE_URL ."views/login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$password) {
    $_SESSION['error_login'] = "Debes completar ambos campos";
    header("Location: ". BASE_URL ."views/login.php");
    exit();
}

$userModel = new User();
$user = $userModel->getByUsername($username);

if (!$user) {
    $_SESSION['error_login'] = "Usuario no encontrado";
    header("Location: ". BASE_URL ."views/login.php");
    exit();
}

if (!password_verify($password, $user->getPassword())) {
    $_SESSION['error_login'] = "Contraseña incorrecta";
    header("Location: ". BASE_URL ."views/login.php");
    exit();
}

// Guardar sesión correctamente
$_SESSION['user'] = [
    'id'       => $user->getId(),
    'username' => $user->getUsername(),
    'email'    => $user->getEmail(),
    'rol'     => $user->getRol()
];

if($user->getRol() == 1){
    header('Location: '. BASE_URL .'index.php?controller=user&action=index');
    exit();
}

header('Location: '. BASE_URL .'views/show.php');

exit();
