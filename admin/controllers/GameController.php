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

    public function store(): void {
        $g = new Game();
        $g->setUserId($_POST['user_id'] ?? null);
        $g->setDifficultyId($_POST['difficulty_id'] ?? null);
        $g->setTotalRounds($_POST['total_rounds'] ?? null);
        $g->setRoundsWon($_POST['rounds_won'] ?? null);
        $g->setResult($_POST['result'] ?? null);

        $g->save();
        header('Location: /VSgame/index.php?controller=game&action=index');
        exit;
    }

    public function delete(): void {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $g = new Game($id);
        $g->delete($id);

        header('Location: /VSgame/index.php?controller=game&action=index');
        exit;
    }
}
