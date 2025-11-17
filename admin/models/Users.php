<?php

namespace admin\models;

use admin\models\Database;
use admin\models\User;
use PDO;

class Users{
    private $db;
    private $con;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->con = $this->db->connect();
    }
    
    //Getters

    //Setters

    public function get(): array {
        $sql = "SELECT * FROM users";
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
    public function find(int $id) : ?User {}

    public function getAllUsers() : array {}

    public function getUserById(int $id) : ?User {}

    public function getByEmail(String $email) : ?User {}

    public function getRanking() : array {}

    //Update
    public function update(User $user) : bool {}

    public function updateScore(User $user) : bool {};
    //Delete
    public function delete(User $user) : bool {}
}