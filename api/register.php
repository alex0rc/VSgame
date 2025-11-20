<?php
namespace api;

use admin\models\User;
use admin\models\Database;

require_once '../../Intermodular/VSgame/admin/config/database.php';

$db = Database::getInstance();
$con = $db->connect();

$id = $_POST['id'] ?? null;
$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$user = new User($id, $username, $email, $password);

try{
    $user->save();
    echo "Registration successful";
}catch(Exception $e){
    echo "Error: ".$e->getMessage();
}