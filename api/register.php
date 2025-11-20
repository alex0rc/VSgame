<?php
namespace api;

use admin\models\User;
use admin\models\Database;

require_once '../../Intermodular/VSgame/admin/config/database.php';

$db = Database::getInstance();
$con = $db->connect();

int $id = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['id'];
string $username = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['username'];
string $email = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['email'];
string $password = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['password'];

$user = new User($id, $username, $email, $password);

try{
    $user->save();
    echo "Registration successful";
}catch(Exception $e){
    echo "Error: ".$e->getMessage();
}