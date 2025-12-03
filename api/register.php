<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../admin/models/User.php';
require_once __DIR__ . '/../admin/models/Database.php';

use admin\models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error_register'] = "Acceso denegado";
    header("Location: ". BASE_URL ."views/register.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$email || !$password) {
    $_SESSION['error_register'] = "Faltan datos por completar";
    header("Location: ". BASE_URL ."views/register.php");
    exit();
}

$userModel = new User();

// Comprobar si el usuario ya existe
if ($userModel->getByUsername($username)) {
    $_SESSION['error_register'] = "El nombre de usuario ya está registrado";
    header("Location: ". BASE_URL ."views/register.php");
    exit();
}

if ($userModel->getByEmail($email)) {
    $_SESSION['error_register'] = "El correo ya está registrado";
    header("Location: ". BASE_URL ."views/register.php");
    exit();
}

// Crear usuario
$newUser = new User(null, $username, $email, $password);

if ($newUser->save()) {

    $_SESSION['success_register'] = "Registro exitoso, ahora inicia sesión";
    header('Location: '. BASE_URL .'views/login.php');
    exit();
} else {
    $_SESSION['error_register'] = "Error al registrar el usuario";
    header("Location: ". BASE_URL ."views/register.php");
    exit();
}