<?php
namespace admin\models;

require_once __DIR__.'/Database.php';

use admin\models\Database;
use PDO;

class Game{
    private $db;
    private $con;

    private int $id;
    private int $user_id;
    private int $difficulty_id;
    private int $total_rounds = 5;
    private int $rounds_won;
    private bool $result;

    public function __construct(int $user_id, int $difficulty_id, bool $result, int $total_rounds = 5, int $rounds_won = 0){
        $this->db = Database::getInstance();
        $this->con = $this->db->connect();
    }

    //Getters

    //Setters

    public function get(): array {
        $sql = "SELECT * FROM games";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all() : array {
        return $this->get();
    }

    //Create
    //public function save() : bool {}

    //Read
    //public function find(int $id) : ?Game {}

    //public function getAllGames() : array {}

    //public function getUserGames(int $id) : array {}

    //public function getUserStats(int $id) : array {}
}