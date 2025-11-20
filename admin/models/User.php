<?php

usernamespace admin\models;

use admin\models\Database;
use admin\models\User;
use PDO;

class User{
    private $db;
    private $con;
    
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $wins;
    private int $losses;


    public function __construct(?int $id = null, ?string $username = null, ?string $email = null, ?string $password = null) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);

    $this->db = Database::getInstance();
    $this->con = $this->db->connect();
}

    
    //Getters

    //Setters

    private function mapSingle(?array $row): ?User {
        if (!$row) {
            return null;
        }

        return new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['password'],
            true
        );

    }

    public function get(): array {
        $sql = "SELECT * FROM users";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => $this->mapSingle($row), $rows);
    }

    public function all() : array {
        return $this->get();
    }

    //Create
    public function save() : bool {
        if($this->id == null){
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->con->prepare($sql);
            if($stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password
            ])){
                return true;
            }else{
                return false;
            }
        }else{
            $sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            if($stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password,
            ':id' => $this->id
            ])){
                return true;
            }else{
                return false;
            }
        }
    }

    //Read
    public function find(int $id) : ?User {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function getAllUsers() : array {}

    public function getByEmail(String $email) : ?User {}

    public function getRanking() : array {}

    //Update
    public function updateScore(User $user) : bool {}

    //Delete
    public function delete(User $user) : bool {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $user->id
        ]);
        return $stmt->rowCount() > 0;
    }
}