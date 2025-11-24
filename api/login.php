<?php
session_start();
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

require_once __DIR__ . '/../admin/models/User.php';
require_once __DIR__ . '/../admin/models/Database.php';

use admin\models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit("Acceso denegado");

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$password) exit("Faltan datos");

$userModel = new User();
$user = $userModel->getByUsername($username);

if (!$user) exit("Usuario no encontrado");
if (!password_verify($password, $user->getPassword())) exit("Contraseña incorrecta");

$_SESSION['user'] = [
    'id' => $user->getId(),
    'username' => $user->getUsername(),
    'email' => $user->getEmail(),
    'role' => $user->getRole()
];


// REDIRECCIÓN
if ($_SESSION['user']['role'] === 'admin') {
    header('Location: ../admin/views/dashboard.php');
    exit;
}

header('Location: ../views/show.php');
exit;