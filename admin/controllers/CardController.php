<?php
namespace admin\controllers;

use admin\models\Card;
use admin\validators\CardValidator;

require_once __DIR__.'/../models/Card.php';
require_once __DIR__.'/../validators/CardValidator.php';

class CardController
{
    private CardValidator $validator;

    public function __construct()
    {
        $this->validator = new CardValidator();
    }

    public function index(): void
    {
        $c = new Card();
        $cards = $c->getAllCards();

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/list.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/create.php';
    }

    public function store(): void
    {
        $c = new Card(
            null,
            $_POST['name'] ?? null,
            (int)($_POST['attack'] ?? 0),
            (int)($_POST['defense'] ?? 0),
            $_POST['image'] ?? null
        );

        if (!$this->validator->validateCard($c)) {
            throw new \InvalidArgumentException("Datos de la carta no válidos.");
        }

        $c->save();

        header('Location: ?controller=card&action=index');
        exit;
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $cardModel = new Card();
        $card = $cardModel->find((int)$id);
        if (!$card) throw new \RuntimeException("Carta no encontrada");
        if (!$this->validator->validateCard($card)) throw new \InvalidArgumentException("Datos de la carta no válidos.");

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/cards/edit.php';
    }

    public function update(): void
    {
        $id = $_POST['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        // 1. Construir carta con nuevos valores
        $c = new Card(
            (int)$id,
            $_POST['name'] ?? null,
            (int)($_POST['attack'] ?? 0),
            (int)($_POST['defense'] ?? 0),
            $_POST['image'] ?? null
        );

        // 2. Validar
        if (!$this->validator->validateCard($c)) {
            throw new \InvalidArgumentException("Datos de la carta no válidos.");
        }

        // 3. Guardar cambios
        $c->save();

        header('Location: ?controller=card&action=index');
        exit;
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $c = new Card($id);
        $c->delete($id);

        header('Location: ?controller=card&action=index');
        exit;
    }
}
