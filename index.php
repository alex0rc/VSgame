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

?>