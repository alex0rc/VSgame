<?php
namespace admin\models;

use admin\models\Database;
use PDO;

class Card{
    private $db;
    private $con;

    private ?int $id;
    private string $name;
    private int $attack;
    private int $defense;
    private string $image;

    public function __construct(?int $id = null, ?string $name = null, ?int $attack = null, ?int $defense = null, ?string $image = null) {
    $this->id = $id;
    $this->name = $name;
    $this->attack = $attack;
    $this->defense = $defense;
    $this->image = $image;
    
    $this->db = Database::getInstance();
    $this->con = $this->db->connect();
    }

    //Getters
    public function getId() : ?int { return $this->id; }
    public function getName() : ?string { return $this->name; }
    public function getAttack() : ?int { return $this->attack; }
    public function getDefense() : ?int { return $this->defense; }
    public function getImage() : ?string { return $this->image; }

    //Setters
    public function setId(int $id) : void { $this->id = $id; }
    public function setName(string $name) : void { $this->name = $name; }
    public function setAttack(int $attack) : void { $this->attack = $attack; }
    public function setDefense(int $defense) : void { $this->defense = $defense; }

    private function mapSingle(?array $row): ?Card {
        if (!$row) {
            return null;
        }

        return new Card(
            (int)$row['id'],
            $row['name'],
            (int)$row['attack'],
            (int)$row['defense'],
            $row['image']
        );

    }

    private function mapAll(?array $rows): ?array {
        if (!$rows) {
            return null;
        }

        return array_map(fn($row) => $this->mapSingle($row), $rows);
    }

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
    public function save() : bool {
        if($this->id == null){
            $sql = "INSERT INTO cards (name, attack, defense, image) VALUES (:name, :attack, :defense, :image)";
            $stmt = $this->con->prepare($sql);
            if($stmt->execute([
            ':name' => $this->name,
            ':attack' => $this->attack,
            ':defense' => $this->defense,
            ':image' => $this->image
            ])){
                return true;
            } else {
                return false;
            }
        }else{
            $sql = "UPDATE cards SET name = :name, attack = :attack, defense = :defense, image = :image WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            if($stmt->execute([
            ':name' => $this->name,
            ':attack' => $this->attack,
            ':defense' => $this->defense,
            ':image' => $this->image,
            ':id' => $this->id
            ])){
                return true;
            } else {
                return false;
            }
        }
    }

    //Read
    public function find(int $id) : ?Card {
        $sql = "SELECT * FROM cards WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function getAllCards() : array {
        $sql = "SELECT * FROM cards";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $this->mapAll($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getCardById(int $id) : ?Card {
        $sql = "SELECT * FROM cards WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $this->mapSingle($stmt->fetch(PDO::FETCH_ASSOC));
    }

    //Delete
    public function delete(Card $card) : bool {
        $sql = "DELETE FROM cards WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':id' => $card->id
        ]);
        return $stmt->rowCount() > 0;
    }
}