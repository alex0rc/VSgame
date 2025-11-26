<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../views/show.php");
    exit;
}

if ($_SESSION['user']['rol'] !== 1) {
    header("Location: ../../views/show.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administración - VSgame</title>
    <link rel="stylesheet" href="/VSgame/assets/css/styles.css">
</head>
<body>

<nav class="admin-nav">
    <span class="admin-title">Panel de Administración</span>
    
    <a href="/VSgame/index.php?controller=user&action=index">Usuarios</a>
    <a href="/VSgame/index.php?controller=card&action=index">Cartas</a>
    <a href="/VSgame/index.php?controller=game&action=index">Partidas</a>
    <a href="../../views/show.php">Juego</a>
    <a href="/VSgame/index.php?controller=admin&action=index">Panel admin</a>
    <a href="/VSgame/api/logout.php" class="logout-btn">Salir</a>
</nav>

<hr>
