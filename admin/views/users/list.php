<?php require_once __DIR__ . '/../header.php'; ?>

<h1>Usuarios</h1>

<a href="?controller=user&action=create" class="btn">Crear nuevo usuario</a>

<table border="1" width="100%" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Puntuación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['id']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['score']) ?></td>
                    <td>
                        <a href="?controller=user&action=edit&id=<?= $u['id'] ?>">Editar</a>
                        |
                        <a href="?controller=user&action=delete&id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay usuarios registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>