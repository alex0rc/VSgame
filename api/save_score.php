<?php
session_start();
header('Content-Type: application/json');

use admin\models\Database;
use admin\models\Game;

require_once __DIR__ . '/../admin/models/Database.php';
require_once __DIR__ . '/../admin/models/Game.php';

// Verificar sesión
if (!isset($_SESSION['user'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No hay usuario logueado'
    ]);
    exit();
}

// Leer JSON enviado desde fetch
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Datos inválidos'
    ]);
    exit();
}

$user_id     = $_SESSION['user']['id'];
$totalRounds = intval($data['totalRounds'] ?? 0);
$scorePlayer = intval($data['scorePlayer'] ?? 0);
$scoreCPU    = intval($data['scoreCPU'] ?? 0);

// Resultado final: 1 = gana, 0 = pierde, 2 = empate
$result = ($scorePlayer > $scoreCPU) ? 1 : (($scorePlayer < $scoreCPU) ? 0 : 2);

// Por ahora dificultad por defecto
$difficulty_id = 1;

try {
    // Creamos el objeto Game y guardamos
    $game = new Game(
        $user_id,
        $difficulty_id,
        $result,
        $totalRounds,
        $scorePlayer
    );

    $ok = $game->save();

    echo json_encode([
        'status' => $ok ? 'success' : 'error',
        'message' => $ok ? 'Puntuación guardada' : 'No se pudo guardar'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}