<?php
require_once __DIR__ . '/../config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ".BASE_URL."views/show.php");
    exit;
}

if ($_SESSION['user']['rol'] !== 1) {
    header("Location: ".BASE_URL."views/show.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administración - VSgame</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/api/assets/css/styles.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>

<nav class="admin-nav">
    <span class="admin-title">Panel de Administración</span>
    
    <a href="<?= BASE_URL ?>/index.php?controller=user&action=index">Usuarios</a>
    <a href="<?= BASE_URL ?>/index.php?controller=card&action=index">Cartas</a>
    <a href="<?= BASE_URL ?>/index.php?controller=game&action=index">Partidas</a>
    <a href="<?= BASE_URL ?>/index.php">Juego</a>
    <a href="<?= BASE_URL ?>/index.php">Panel admin</a>
    <a href="<?= BASE_URL ?>/api/logout.php" class="logout-btn">Salir</a>
</nav>
