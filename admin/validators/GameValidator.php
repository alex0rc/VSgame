<?php
namespace admin\validators;

use admin\models\Game;

class GameValidator
{
    public function validateId(?int $id) : bool {
        if ($id === null) return true;
        return $id > 0;
    }

    public function validateUserId(?int $id) : bool {
        if ($id === null) return true;
        return $id > 0;
    }

    public function validateDifficultyId(?int $id) : bool {
        if ($id === null) return true;
        return $id > 0;
    }

    function validateTotalRounds(?int $totalRounds) : bool {
        if ($totalRounds === null) return true;
        return $totalRounds > 0;
    }

    function validateRoundsWon(?int $roundsWon) : bool {
        if ($roundsWon === null) return true;
        return $roundsWon >= 0;
    }

    function validateResult(?string $result) : bool {
        if ($result === null) return true;
        return $result === 'win' || $result === 'lose';
    }

    public function validateGame(Game $game) : bool {
        if (!$this->validateId($game->getId())) return false;
        if (!$this->validateUserId($game->getUserId())) return false;
        if (!$this->validateDifficultyId($game->getDifficultyId())) return false;
        if (!$this->validateTotalRounds($game->getTotalRounds())) return false;
        if (!$this->validateRoundsWon($game->getRoundsWon())) return false;
        if (!$this->validateResult($game->getResult())) return false;

        return true;
    }
}