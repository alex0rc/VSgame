<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: /index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administración - VSgame</title>
    <link rel="stylesheet" href="/api/assets/css/styles.css">
</head>
<body>

<nav class="admin-nav">
    <span class="admin-title">Panel de Administración</span>
    
    <a href="?controller=user&action=list">Usuarios</a>
    <a href="?controller=card&action=list">Cartas</a>
    <a href="?controller=game&action=list">Partidas</a>

    <a href="/api/logout.php" class="logout-btn">Salir</a>
</nav>

<hr>
