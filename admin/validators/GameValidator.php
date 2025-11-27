<?php
namespace admin\validators;

use admin\models\Game;

class GameValidator
{
    public function validateId(?int $id): bool {
        return $id === null || $id > 0;
    }

    public function validateUserId(?int $id): bool {
        return $id !== null && $id > 0;
    }

    public function validateDifficultyId(?int $id): bool {
        return $id !== null && $id > 0;
    }

    public function validateTotalRounds(?int $totalRounds): bool {
        return $totalRounds !== null && $totalRounds > 0;
    }

    public function validateRoundsWon(?int $roundsWon): bool {
        return $roundsWon !== null && $roundsWon >= 0;
    }

    public function validateResult(?string $result): bool {
        return in_array($result, ['win', 'lose'], true);
    }

    private function validateConsistency(Game $g): bool {
        if ($g->getRoundsWon() > $g->getTotalRounds()) return false;

        if ($g->getResult() === 'win' && $g->getRoundsWon() <= $g->getTotalRounds() / 2) return false;
        if ($g->getResult() === 'lose' && $g->getRoundsWon() >= $g->getTotalRounds() / 2) return false;

        return true;
    }

    public function validateGame(Game $game): bool {
        if (!$this->validateId($game->getId())) return false;
        if (!$this->validateUserId($game->getUserId())) return false;
        if (!$this->validateDifficultyId($game->getDifficultyId())) return false;
        if (!$this->validateTotalRounds($game->getTotalRounds())) return false;
        if (!$this->validateRoundsWon($game->getRoundsWon())) return false;
        if (!$this->validateResult($game->getResult())) return false;

        if (!$this->validateConsistency($game)) return false;

        return true;
    }
}
