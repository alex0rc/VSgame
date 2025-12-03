<?php
namespace admin\validators;

use admin\models\Card;

class CardValidator
{
    function validateId(?int $id) : bool {
        if ($id === null) return true;
        return $id > 0;
    }

    function validateImageName(string $name): bool {
        if (preg_match('/\s/', $name)) return false;
        if (str_contains($name, '/') || str_contains($name, '\\')) return false;

        $pattern = '/^[a-zA-Z0-9_\-]+\.(jpg|jpeg|png|gif|webp)$/i';

        return (bool) preg_match($pattern, $name);
    }

    function validateAttack(int $attack): bool {
        return $attack >= 0;
    }

    function validateDefense(int $defense): bool {
        return $defense >= 0;
    }

    function validateName(string $name): bool {
        if (preg_match('/\s/', $name)) return false;
        if (str_contains($name, '/') || str_contains($name, '\\')) return false;
        return true;
    }

    function validateCard(Card $card) : bool {

        if (!$this->validateId($card->getId())) return false;
        if (!$this->validateImageName($card->getImage())) return false;
        if (!$this->validateName($card->getName())) return false;
        if (!$this->validateAttack($card->getAttack())) return false;
        if (!$this->validateDefense($card->getDefense())) return false;

        return true;
    }
}
