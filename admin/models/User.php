<?php

namespace admin\models;

use admin\models\Database;
use PDO;

class User{
    private $db;
    private $con;
    
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $wins;
    private int $losses;

    private bool $isHashed = false;


    public function __construct(?int $id = null, ?string $username = null, ?string $email = null, ?string $password = null, bool $isHashed = false) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->isHashed = $isHashed;
    
    $this->password = $this->isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);

    $this->db = Database::getInstance();
    $this->con = $this->db->connect();
}

    
    //Getters
    public function getId() : ?int { return $this->id; }
    public function getUsername() : ?string { return $this->username; }
    public function getEmail() : ?string { return $this->email; }
    public function getPassword() : ?string { return $this->password; }
    public function getWins() : ?int { return $this->wins; }
    public function getLosses() : ?int { return $this->losses; }

    //Setters
    public function setId(int $id) : void { $this->id = $id; }
    public function setUsername(string $username) : void { $this->username = $username; }
    public function setEmail(string $email) : void { $this->email = $email; }
    public function setPassword(string $password) : void { $this->password = $password; }
    public function setWins(int $wins) : void { $this->wins = $wins; }
    public function setLosses(int $losses) : void { $this->losses = $losses; }

    private function mapSingle(?array $row): ?User {
        if (!$row) {
            return null;
        }

        return new User(
            (int)$row['id'],
            $row['username'],
            $row['email'],
            $row['password'],
            true
        );

    }

    private function mapAll(?array $rows): ?array {
        if (!$rows) {
            return null;
        }

        return array_map(fn($row) => $this->mapSingle($row), $rows);
    }

    public function get(): array {
        $sql = "SELECT * FROM users";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getAllUsers() : array {
        $sql = "SELECT * FROM users";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $this->mapAll($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getByEmail(String $email) : ?User {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function getByUsername(String $username) : ?User {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    //public function getRanking() : array {}

    //Update
    //public function updateScore(User $user) : bool {}

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