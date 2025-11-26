<?php require_once __DIR__ . '/../dashboard.php'; ?>

<h1>Cartas</h1>

<a href="?controller=card&action=create" class="btn">Crear nueva carta</a>

<table border="1" width="100%" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ataque</th>
            <th>Defensa</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cards)): ?>
            <?php foreach ($cards as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['id']) ?></td>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['attack']) ?></td>
                    <td><?= htmlspecialchars($c['defense']) ?></td>                    
                    <td><?= htmlspecialchars($c['image']) ?></td>
                    <td>
                        <a href="?controller=card&action=edit&id=<?= $c['id'] ?>">Editar</a>
                        |
                        <a href="?controller=card&action=delete&id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar carta?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay cartas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>