<?php
namespace admin\controllers;

use admin\models\Game;

require_once __DIR__ . '/../models/Game.php';

class GameController {
    public function index(): void {
        $u = new Game();
        $games = $u->getAllGames();
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/games/list.php';
    }

    public function create(): void {
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/games/create.php';
    }

    public function store(): void {
        $g = new Game();
        $g->setUserId($_POST['user_id'] ?? null);
        $g->setDifficultyId($_POST['difficulty_id'] ?? null);
        $g->setTotalRounds($_POST['total_rounds'] ?? null);
        $g->setRoundsWon($_POST['rounds_won'] ?? null);
        $g->setResult($_POST['result'] ?? null);

        $g->save();
        header('Location: /VSgame/index.php?controller=user&action=index');
        exit;
    }

    public function update(): void {
        $id = $_POST['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $g = new Game($id);
        $g->setUserId($_POST['user_id'] ?? null);
        $g->setDifficultyId($_POST['difficulty_id'] ?? null);
        $g->setTotalRounds($_POST['total_rounds'] ?? null);
        $g->setRoundsWon($_POST['rounds_won'] ?? null);
        $g->setResult($_POST['result'] ?? null);

        $g->save();
        header('Location: /VSgame/index.php?controller=user&action=index');
        exit;
    }

    public function edit(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $gameModel = new Game();
        $game = $gameModel->find((int)$id);
        if (!$game) throw new \RuntimeException("Partida no encontrada");

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/games/edit.php';
    }


    public function delete(): void {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $u = new Game($id);
        $u->delete($id);

        header('Location: /VSgame/index.php?controller=user&action=index');
        exit;
    }
}
