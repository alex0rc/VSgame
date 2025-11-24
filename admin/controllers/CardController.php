<?php
namespace admin\controllers;

use admin\models\Card;

require_once __DIR__.'/../models/Card.php';

class CardController{
    public function index() : void{
        $c = new Card();
        $cards = $c->getAllCards();

        if($cards != null){
            require __DIR__ . '/../views/cards/list.php';
        }
    }

    public function store(Card $card) : void{
        if($card == null){
            throw new \InvalidArgumentException('No se proporcionó una carta');
        } else {
            $card->save();
            header('Location: ?controller=card&action=list');
        }
    }

    public function update(Card $card) : void{
        if($card == null){
            throw new \InvalidArgumentException('No se proporcionó una carta');
        } else {
            $card->save();
            header('Location: ?controller=user&action=list');
        }
    }
}