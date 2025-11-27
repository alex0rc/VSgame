<?php

namespace admin\models;

require_once __DIR__ . '/Database.php';

use admin\models\Database;
use PDO;
use Exception;

class Game
{

    private $con;

    private ?int $id;
    private ?int $user_id;
    private ?int $difficulty_id;
    private ?string $date;
    private ?int $total_rounds;
    private ?int $rounds_won;
    private ?int $result;

    public function __construct( ?int $id = null, ?int $user_id = null, ?int $difficulty_id = null, ?string $date = null, ?int $total_rounds = null, ?int $rounds_won = null, ?int $result = null)
    {
        $this->con = Database::getInstance()->connect();

        $this->id = $id;
        $this->user_id = $user_id;
        $this->difficulty_id = $difficulty_id;
        $this->date = $date;
        $this->total_rounds = $total_rounds;
        $this->rounds_won = $rounds_won;
        $this->result = $result;
    }

    //Setters
    public function setId(int $id) : void { $this->id = $id; }
    public function setUserId(int $user_id) : void { $this->user_id = $user_id; }
    public function setDifficultyId(int $difficulty_id) : void { $this->difficulty_id = $difficulty_id; }
    public function setTotalRounds(int $total_rounds) : void { $this->total_rounds = $total_rounds; }
    public function setRoundsWon(int $rounds_won) : void { $this->rounds_won = $rounds_won; }
    public function setResult(int $result) : void { $this->result = $result; }

    //Getters
    public function getId() : ?int { return $this->id; }
    public function getUserId() : ?int { return $this->user_id; }
    public function getDifficultyId() : ?int { return $this->difficulty_id; }
    public function getDate() : ?string { return $this->date; }
    public function getTotalRounds() : ?int { return $this->total_rounds; }
    public function getRoundsWon() : ?int { return $this->rounds_won; }
    public function getResult() : ?int { return $this->result; }

    private function mapSingle(?array $row): ?Game
    {
        if (empty($row) || !is_array($row)) {
            return null;
        }

        return new Game(
            (int)$row['id'],
            (int)$row['user_id'],
            (int)$row['difficulty_id'],
            (string)$row['date'],
            (int)$row['total_rounds'],
            (int)$row['rounds_won'],
            (int)$row['result']
        );
    }


    private function mapAll(?array $rows): ?array
    {
        if (!$rows) {
            return null;
        }

        return array_map(fn($row) => $this->mapSingle($row), $rows);
    }

    public function get(): array
    {
        $sql = "SELECT * FROM games";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => $this->mapSingle($row), $rows);
    }

    public function all(): array
    {
        return $this->get();
    }

    //Create
public function save(): bool
{
    $this->result = (int)$this->result;

    if ($this->id === null) {
        // Nueva partida
        $sql = "INSERT INTO games (user_id, difficulty_id, total_rounds, rounds_won, result)
                VALUES (:user_id, :difficulty_id, :total_rounds, :rounds_won, :result)";
        $stmt = $this->con->prepare($sql);
        $inserted = $stmt->execute([
            ':user_id'       => $this->user_id,
            ':difficulty_id' => $this->difficulty_id,
            ':total_rounds'  => $this->total_rounds,
            ':rounds_won'    => $this->rounds_won,
            ':result'        => $this->result
        ]);

        if ($inserted) {
            $sql2 = $this->result === 1
                ? "UPDATE users SET wins = wins + 1 WHERE id = :user_id"
                : "UPDATE users SET losses = losses + 1 WHERE id = :user_id";
            $stmt2 = $this->con->prepare($sql2);
            $stmt2->execute([':user_id' => $this->user_id]);
            return true;
        }
        return false;
    } else {
        // Partida existente
        // Obtener resultado y user_id previos
        $sqlPrev = "SELECT user_id, result FROM games WHERE id = :id";
        $stmtPrev = $this->con->prepare($sqlPrev);
        $stmtPrev->execute([':id' => $this->id]);
        $prev = $stmtPrev->fetch(\PDO::FETCH_ASSOC);
        $prevUserId = (int)$prev['user_id'];
        $prevResult = (int)$prev['result'];

        // Ajustar estadísticas del usuario previo si cambió el resultado
        if ($prevResult !== $this->result || $prevUserId !== $this->user_id) {
            // Restar del usuario original
            if ($prevResult === 1) {
                $sqlAdj = "UPDATE users SET wins = wins - 1 WHERE id = :user_id";
                $stmtAdj = $this->con->prepare($sqlAdj);
                $stmtAdj->execute([':user_id' => $prevUserId]);
            } else {
                $sqlAdj = "UPDATE users SET losses = losses - 1 WHERE id = :user_id";
                $stmtAdj = $this->con->prepare($sqlAdj);
                $stmtAdj->execute([':user_id' => $prevUserId]);
            }

            // Sumar al usuario actual
            if ($this->result === 1) {
                $sqlAdj = "UPDATE users SET wins = wins + 1 WHERE id = :user_id";
                $stmtAdj = $this->con->prepare($sqlAdj);
                $stmtAdj->execute([':user_id' => $this->user_id]);
            } else {
                $sqlAdj = "UPDATE users SET losses = losses + 1 WHERE id = :user_id";
                $stmtAdj = $this->con->prepare($sqlAdj);
                $stmtAdj->execute([':user_id' => $this->user_id]);
            }
        }

        // Actualizar partida
        $sql = "UPDATE games 
                SET user_id = :user_id, difficulty_id = :difficulty_id, total_rounds = :total_rounds, rounds_won = :rounds_won, result = :result
                WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            ':id'            => $this->id,
            ':user_id'       => $this->user_id,
            ':difficulty_id' => $this->difficulty_id,
            ':total_rounds'  => $this->total_rounds,
            ':rounds_won'    => $this->rounds_won,
            ':result'        => $this->result
        ]);
    }
}




    //Read
    public function find(int $id): ?Game
    {
        $sql = "SELECT * FROM games WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function getAllGames(): array
    {
        $sql = "SELECT * FROM games";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $this->mapAll($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    //Delete
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->rowCount() > 0;
    }
}