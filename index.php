<?
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'controllerdefecto';
$action = isset($_GET['action']) ? $_GET['action'] : 'actiondefecto';

$controllerFile = "controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = ucfirst($controller) . "Controller";

if (file_exists($controllerFile)) {
require_once $controllerFile;

if (class_exists($controllerClass)) {
$controllerObject = new $controllerClass();

if (method_exists($controllerObject, $action)) {
$controllerObject->$action();
} else {
echo "Error: Acción '$action' no encontrada en el controlador
'$controllerClass'.";
}
} else {
echo "Error: Clase de controlador '$controllerClass' no encontrada.";
}
} else {
echo "Error: Archivo de controlador '$controllerFile' no encontrado.";
}
?>