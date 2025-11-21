Database.php

<?php
namespace admin\models;
use PDO;
use Exception;
use PDOException;

class Database{
    //Instancia estática de la clase para el Singleton
    private static ?Database $instance = null;
    //Conexión pdo
    private ?PDO $connection = null;

    //Credenciales
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'vsgame';

    private function __construct(){
        //Se inicializa la conexión PDO al construir una única instancia
        try{
            $this->connection = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbname,
            $this->username,
            $this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
            );
        }catch(PDOException $e){
            throw new Exception("Error de conexión a la base de datos: ".$e->getMessage());
        }
    }

    //Método público estático para obtener la única instancia
    public static function getInstance() : Database{
        if(self::$instance===null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect() : PDO{
        return $this->connection;
    }
}