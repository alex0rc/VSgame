<?php
require_once __DIR__ . '/config.php';

if (empty($_GET)) {
    header("Location: " . BASE_URL."views/show.php");
    exit;
}

// 1) IMÁGENES — manejar primero
if (isset($_GET['image'])) {
    $imageName = basename($_GET['image']);
    $folder = 'img';

    if (str_starts_with($imageName, 'cards/')) {
        $folder = 'img/cards';
        $imageName = substr($imageName, 6);
    }

    $imagePath = BASE_URL . "/$folder/$imageName";

    if (file_exists($imagePath)) {
        $ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        header("Content-Type: image/$ext");
        readfile($imagePath);
        exit;
    }

    http_response_code(404);
    echo "Imagen no encontrada.";
    exit;
}


// 2) VISTAS DIRECTAS
if (isset($_GET['view'])) {
    $viewFile = BASE_URL . "/views/" . $_GET['view'] . ".php";

    if (file_exists($viewFile)) {
        require $viewFile;
        exit;
    }

    echo "Error: Vista '{$_GET['view']}' no encontrada.";
    exit;
}


// 3) CONTROLADORES MVC
$controller = $_GET['controller'] ?? 'user';
$action = $_GET['action'] ?? 'index';

$controllerFile = "admin/controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = "admin\\controllers\\" . ucfirst($controller) . "Controller";

if (!file_exists($controllerFile)) {
    echo "Error: Archivo '$controllerFile' no encontrado.";
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    echo "Error: Clase '$controllerClass' no encontrada.";
    exit;
}

$controllerObject = new $controllerClass();

if (!method_exists($controllerObject, $action)) {
    echo "Error: Acción '$action' no encontrada.";
    exit;
}

$controllerObject->$action();
exit;