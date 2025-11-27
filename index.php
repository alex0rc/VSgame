<?php

if (isset($_GET['view'])) {
    $view = $_GET['view'];

    $viewFile = __DIR__. "/views/" . $view . ".php";

    if (file_exists($viewFile)) {
        require $viewFile;
        exit;
    } else {
        echo "Error: Vista '$view' no encontrada.";
        exit;
    }
}

$controller = $_GET['controller'] ?? 'user';
$action = $_GET['action'] ?? 'index';

$controllerFile = "admin/controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = "admin\\controllers\\" . ucfirst($controller) . "Controller";

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();

        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            echo "Error: Acción '$action' no encontrada.";
        }
    } else {
        echo "Error: Clase '$controllerClass' no encontrada.";
    }
} else {
    echo "Error: Archivo '$controllerFile' no encontrado.";
}

// Servir imágenes desde /assets/img
if (isset($_GET['image'])) {
    $imageName = basename($_GET['image']);
    $folder = 'img';

    // Si empieza con 'cards/', se sirve desde la subcarpeta cards
    if (str_starts_with($imageName, 'cards/')) {
        $folder = 'img/cards';
        $imageName = substr($imageName, 6);
    }

    $imagePath = __DIR__ . "/assets/$folder/" . $imageName;

    if (file_exists($imagePath)) {
        $ext = pathinfo($imagePath, PATHINFO_EXTENSION);
        switch (strtolower($ext)) {
            case 'jpg':
            case 'jpeg': header('Content-Type: image/jpeg'); break;
            case 'png': header('Content-Type: image/png'); break;
            case 'gif': header('Content-Type: image/gif'); break;
            default: header('Content-Type: application/octet-stream');
        }
        readfile($imagePath);
        exit;
    } else {
        http_response_code(404);
        echo "Imagen no encontrada.";
        exit;
    }
}


?>