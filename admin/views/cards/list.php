<main class="main-content">
    <h1>Cartas</h1>

<a href="/index.php?controller=card&action=create" class="btn">Crear nueva carta</a>

<table border="1" width="100%" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ataque</th>
            <th>Defensa</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cards)): ?>
            <?php foreach ($cards as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c->getId()) ?></td>
                    <td><?= htmlspecialchars($c->getName()) ?></td>
                    <td><?= htmlspecialchars($c->getAttack()) ?></td>
                    <td><?= htmlspecialchars($c->getDefense()) ?></td>                    
                    <td><?= htmlspecialchars($c->getImage()) ?></td>
                    <td>
                        <a href="?controller=card&action=edit&id=<?= $c->getId() ?>" class="table-btn edit">Editar</a>
                        |
                        <a href="?controller=card&action=delete&id=<?= $c->getId() ?>" onclick="return confirm('¿Eliminar carta?');" class="table-btn delete">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay cartas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</main>