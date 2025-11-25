<?php
session_start();

// Autoload para los controladores
spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class);

    $paths = [
        __DIR__ . '/admin/controllers/' . $class . '.php',
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/api/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Obtener URL y limpiar
$request = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];

// Quitar el path del script si lo hay
$basePath = str_replace(basename($scriptName), '', $scriptName);
$path = str_replace($basePath, '', $request);
$path = trim($path, '/');

// Separar partes de la ruta
$segments = explode('/', $path);

// Determinar controlador y método
$controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
$method = $segments[1] ?? 'index';
$params = array_slice($segments, 2);

// Verificar si el controlador existe
if (class_exists($controllerName)) {
    $controller = new $controllerName();

    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        http_response_code(404);
        echo "Método $method no encontrado en $controllerName";
    }
} else {
    http_response_code(404);
    echo "Controlador $controllerName no encontrado";
}
