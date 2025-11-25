<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../views/show.php");
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/show.php");
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
    <a href="../views/show.php">Juego</a>
    <a href="?controller=admin&action=index">Panel de administración</a>


    <a href="../api/logout.php" class="logout-btn">Salir</a>
</nav>

<hr>
