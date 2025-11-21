<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VSGAME - Registro</title>
    <link rel="stylesheet" href="../assets/scss/style.css">
</head>

<body>
    <div class="form-container">
        <h1>VSGAME</h1>
        <h2>Registro</h2>

        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

        <form method="POST" action="../api/register.php" id="registerForm">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes cuenta?
            <a href="./login.php">Iniciar Sesión</a>
        </p>
    </div>
</body>

</html>
