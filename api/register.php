<?php
session_start();

require_once __DIR__ . '/../admin/models/User.php';
require_once __DIR__ . '/../admin/models/Database.php';

use admin\models\User;

// Comprobamos que vienen datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Acceso denegado");
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validación básica
if (!$username || !$email || !$password) {
    exit("Faltan datos");
}

$userModel = new User();

// Comprobar si el usuario ya existe
if ($userModel->getByUsername($username)) {
    exit("El nombre de usuario ya existe");
}

if ($userModel->getByEmail($email)) {
    exit("El email ya está registrado");
}

// Crear nuevo usuario (la contraseña se hashea automáticamente)
$newUser = new User(null, $username, $email, $password);
if ($newUser->save()) {
    // Guardamos sesión directamente
    $_SESSION['user'] = [
        'id' => $newUser->getId(),
        'username' => $newUser->getUsername(),
        'email' => $newUser->getEmail()
    ];

    header('Location: ../views/login.php');
    exit;
} else {
    exit("Error al registrar el usuario");
}