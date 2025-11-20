<?php
namespace api;

use admin\models\User;
use admin\models\Database;

require_once '../../Intermodular/VSgame/admin/config/database.php';

$db = Database::getInstance();
$con = $db->connect();

