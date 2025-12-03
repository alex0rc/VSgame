<?php
session_start();
require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VSGAME - Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/scss/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <h1>VSGAME</h1>
        <h2>Iniciar Sesión</h2>
        <?php
        if (isset($_SESSION['error_login'])) {
            echo "<div class='error-box'>" . $_SESSION['error_login'] . "</div>";
            unset($_SESSION['error_login']);
        }
        if (isset($_SESSION['success_register'])) {
            echo "<div class='success-box'>" . $_SESSION['success_register'] . "</div>";
            unset($_SESSION['success_register']);
        }
        ?>


        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="<?= BASE_URL ?>api/login.php" id="loginForm">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta?
            <a href="./register.php">Regístrate</a>
        </p>
    </div>
    <script src="<?= BASE_URL ?>assets/js/form-validator.js"></script>
</body>

</html>
