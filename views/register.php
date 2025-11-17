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

        <form id="loginForm">
            <label>Username</label>
            <input type="text" id="username" required>

            <label>Email:</label>
            <input type="email" id="email" required>

            <label>Contraseña:</label>
            <input type="password" id="password" required>

            <button type="submit">Entrar</button>
        </form>

        <p>¿Ya tienes cuenta?
            <a href="./login.php">Iniciar Sesión</a>
        </p>
    </div>
</body>

</html>
