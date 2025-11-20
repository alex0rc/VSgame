<?php
namespace admin\models;

class Database{
    //Instancia estática de la clase para el Singleton
    private static $instance = null;
    //Conexión pdo
    private $con;

    //Credenciales
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'admin';

    private function __construct(){
        //Se inicializa la conexión PDO al construir una única instancia
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        try{
            $this->con = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $e){
            throw new Exception("Error de conexión a la base de datos: ".$e->getMessage());
        }
    }

    //Método público estático para obtener la única instancia
    public static function getInstance(){
        if(self::$instnace==null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect(){
        return $this->con;
    }
}