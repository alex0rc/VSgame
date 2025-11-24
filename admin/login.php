<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="/api/assets/css/styles.css">
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <?php if (!empty($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="../api/login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn-primary">Entrar</button>
    </form>
</div>

</body>
</html>
