<?php
require_once __DIR__ . '/config.php';

if (!isset($_GET['controller']) && !isset($_GET['action']) && !isset($_GET['view'])) {
    header("Location: ?view=show");
    exit;
}

//$imagePath = BASE_URL . "/assets/$folder" . $imageName ?? '';

$controller = $_GET['controller'] ?? 'user';
$action = $_GET['action'] ?? 'index';

$controllerFile = "admin/controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = "admin\\controllers\\" . ucfirst($controller) . "Controller";

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

if (isset($_GET['image'])) {
    $imageName = basename($_GET['image']);
    $folder = 'img';

    if (str_starts_with($imageName, 'cards/')) {
        $folder = 'img/cards';
        $imageName = substr($imageName, 6);
    }

    if (file_exists($imagePath)) {
        $ext = pathinfo($imagePath, PATHINFO_EXTENSION);
        switch (strtolower($ext)) {
            case 'jpg':
            case 'png': header('Content-Type: image/png'); break;
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