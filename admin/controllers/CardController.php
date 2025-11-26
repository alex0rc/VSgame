<?php
namespace admin\controllers;

use admin\models\Card;

require_once __DIR__.'/../models/Card.php';

class CardController{
    public function index() : void{
        $c = new Card();
        $cards = $c->getAllCards();

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/list.php';
    }

    public function create(): void {
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/create.php';
    }

    public function store() : void{
        $c = new Card();
        $c->setName($_POST['name'] ?? null);
        $c->setAttack($_POST['attack'] ?? null);
        $c->setDefense($_POST['defense'] ?? null);
        $c->setImage($_POST['image'] ?? null);

        $c->save();

        header('Location: ?controller=card&action=index');
        exit;
    }

    public function edit(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $cardModel = new Card();
        $card = $cardModel->find((int)$id);
        if (!$card) throw new \RuntimeException("Usuario no encontrado");

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/edit.php';
    }

    public function update() : void{
        $id = $_POST['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $c = new Card($id);
        $c->setName($_POST['name'] ?? null);
        $c->setAttack($_POST['attack'] ?? null);
        $c->setDefense($_POST['defense'] ?? null);
        $c->setImage($_POST['image'] ?? null);

        $c->save();

        header('Location: /VSgame/index.php?controller=card&action=index');
        exit;
    }

    public function delete() : void{
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $c = new Card($id);
        $c->delete($id);

        header('Location: /VSgame/index.php?controller=card&action=index');
        exit;
    }
}