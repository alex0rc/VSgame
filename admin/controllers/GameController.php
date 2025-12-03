<?php
namespace admin\controllers;

use admin\models\Game;
use admin\validators\GameValidator;

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../models/Game.php';

class GameController 
{
    private GameValidator $validator;

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

        if (!$this->validator->validateGame($g)) { throw new \InvalidArgumentException("Datos de la partida no válidos."); }

        $g->setUserId($_POST['user_id'] ?? null);
        $g->setDifficultyId($_POST['difficulty_id'] ?? null);
        $g->setTotalRounds($_POST['total_rounds'] ?? null);
        $g->setRoundsWon($_POST['rounds_won'] ?? null);
        $g->setResult($_POST['result'] ?? null);

        $g->save();
        header('Location: ' . BASE_URL . '/index.php?controller=game&action=index');
        exit;
    }

    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $g = new Game($id);

        if (!$this->validator->validateGame($g)) { throw new \InvalidArgumentException("Datos de la partida no válidos."); }

        $g->setUserId($_POST['user_id'] ?? null);
        $g->setDifficultyId($_POST['difficulty_id'] ?? null);
        $g->setTotalRounds($_POST['total_rounds'] ?? null);
        $g->setRoundsWon($_POST['rounds_won'] ?? null);
        $g->setResult($_POST['result'] ?? null);

        $g->save();
        header('Location: /index.php?controller=game&action=index');
        exit;
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $gameModel = new Game();

        if (!$this->validator->validateGame($gameModel)) { throw new \InvalidArgumentException("Datos de la partida no válidos."); }

        $game = $gameModel->find((int)$id);
        if (!$game) throw new \RuntimeException("Usuario no encontrado");

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/games/edit.php';
    }

    public function delete(): void {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $g = new Game($id);
        $g->delete($id);

        header('Location: ' . BASE_URL . '/index.php?controller=game&action=index');
        exit;
    }
}
