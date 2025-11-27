<main class="main-content">
    <h1>Partidas</h1>

<a href="/VSgame/index.php?controller=game&action=create" class="btn">Crear nueva partida</a>


<table border="1" width="100%" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID del jugador</th>
            <th>ID de la dificultad</th>
            <th>Fecha</th>
            <th>Rondas totales</th>
            <th>Rondas ganadas</th>
            <th>Resultado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($games)): ?>
            <?php foreach ($games as $g): ?>
                <tr>
                    <td><?= $g->getId() ?></td>
                    <td><?= $g->getUserId() ?></td>
                    <td><?= $g->getDifficultyId() ?></td>
                    <td><?= $g->getDate() ?></td>
                    <td><?= $g->getTotalRounds() ?></td>
                    <td><?= $g->getRoundsWon() ?></td>
                    <td><?= $g->getResult() ?></td>
                    <td>
                        <a href="/VSgame/index.php?controller=game&action=edit&id=<?= $g->getId() ?>" class="table-btn edit">Editar</a>
                        |
                        <a href="/VSgame/index.php?controller=game&action=delete&id=<?= $g->getId() ?>" onclick="return confirm('¿Eliminar Partida?');" class="table-btn delete">Eliminar</a>
                    </td>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay partidas registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</main>