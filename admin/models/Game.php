<?php

namespace admin\models;

require_once __DIR__ . '/Database.php';

use admin\models\Database;
use PDO;
use Exception;

class Game
{

    private $con;

    private int $user_id;
    private int $difficulty_id;
    private int $total_rounds;
    private int $rounds_won;
    private int $result;

    public function __construct(int $user_id, int $difficulty_id, int $result, int $total_rounds, int $rounds_won)
    {
        $this->con = Database::getInstance()->connect();

        $this->user_id = $user_id;
        $this->difficulty_id = $difficulty_id;
        $this->total_rounds = $total_rounds;
        $this->rounds_won = $rounds_won;
        $this->result = $result;
    }

    // GUARDAR PARTIDA
    public function save(): bool
    {
        $sql = "INSERT INTO games (user_id, difficulty_id, total_rounds, rounds_won, result)
                VALUES (:user_id, :difficulty_id, :total_rounds, :rounds_won, :result)";

        $stmt = $this->con->prepare($sql);

        return $stmt->execute([
            ':user_id'       => $this->user_id,
            ':difficulty_id' => $this->difficulty_id,
            ':total_rounds'  => $this->total_rounds,
            ':rounds_won'    => $this->rounds_won,
            ':result'        => $this->result
        ]);
    }

    public function all(): array
    {
        $sql = "SELECT * FROM games";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}