<?php
session_start();
header('Content-Type: application/json');

use admin\models\Database;

require_once __DIR__ . '/../admin/models/Database.php';

try {
    $db = Database::getInstance()->connect();
    $stmt = $db->prepare("SELECT id, name, attack, defense, image FROM cards");
    $stmt->execute();
    $cards = $stmt->fetchAll();

    echo json_encode([
        'status' => 'success',
        'cards' => $cards
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}