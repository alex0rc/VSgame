<?php
namespace admin\models;

use admin\models\Database;
use admin\models\Game;
use PDO;

class Game{
    private $db;
    private $con;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->con = $this->db->connect();
    }

    //Getters

    //Setters

    public function get(): array {
        $sql = "SELECT * FROM games";
        $stmt $this->con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all() : array {
        return $this->get();
    }

    //Create
    public function save() : bool {}

    //Read
    public function find(int $id) : ?Game {}

    public function getAllGames() : array {}

    public function getUserGames(int $id) : array {}

    public function getUserStats(int $id) : array {}
}