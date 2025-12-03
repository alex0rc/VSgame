<main class="main-content">
    <h1>Usuarios</h1>

<a href="/index.php?controller=user&action=create" class="btn">Crear nuevo usuario</a>

<table border="1" width="100%" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nombre de usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u->getId()) ?></td>
                    <td><?= htmlspecialchars($u->getEmail()) ?></td>
                    <td><?= htmlspecialchars($u->getUsername()) ?></td>
                    <td>
                        <a href="/VSgame/index.php?controller=user&action=edit&id=<?= $u->getId() ?>" class="table-btn edit">Editar</a>
                        |
                        <a href="/VSgame/index.php?controller=user&action=delete&id=<?= $u->getId() ?>" onclick="return confirm('¿Eliminar usuario?');" class="table-btn delete">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay usuarios registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</main>