<?php
namespace admin\models;

use admin\models\Database;
use PDO;

class Card{
    private $db;
    private $con;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->con = $this->db->connect();
    }

    //Getters

    //Setters

    public function get(): array {
        $sql = "SELECT * FROM cards";
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
    //public function find(int $id) : ?Card {}

    //public function getAllCards() : array {}

    //public function getCardById(int $id) : ?Card {}

    //Update
    //public function update(Card $card) : bool {}

    //Delete
    //public function delete(Card $card) : bool {}
}