<?php 


session_start();

require_once('../vendor/autoload.php');
require_once('../app/config/constantes.php');

use App\Controller\EncuestasController;
use App\Controller\IndexController;
use App\Controller\PreguntasController;
use App\Core\Router;

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = 'invitado';
    $_SESSION['usuario'] = "";
    // variables de sesion creadas por defecto.

}

$router = new Router();
$router->add(array(
    'name' => 'indexAction',
    'path' => '/^\/||\/w+$/',
    'action' => [IndexController::class, 'indexAction'],
    'auth' => ['invitado', 'usuario', 'admin']
));

// el barra admin te lleva al admin_view ó poner if en el index_view.php

$router->add(array(
    'name' => 'crearPreguntas',
    'path' => '/^\/admin\/crear_pregunta$/',
    'action' => [PreguntasController::class, 'crearPreguntas'],
    'auth' => ['admin']
));

$router->add(array(
    'name' => 'crearEncuestas',
    'path' => '/^\/admin\/crear_encuesta$/',
    'action' => [EncuestasController::class, 'crearEncuestas'],
    'auth' => ['admin']
));

$router->add(array(
    'name' => 'responderEncuesta',
    'path' => '/^\/usuario\/responder_encuesta$/',
    'action' => [EncuestasController::class, 'responderEncuesta'],
    'auth' => ['usuario']
));

$router->add(array(
    'name' => 'cerrarSesion',
    'path' => '/^\/salir$/',
    'action' => [IndexController::class, 'cerrarSesion'],
    'auth' => ['usuario', 'admin']
));

$router->add(array(
    'name' => 'registro',
    'path' => '/^\/registro$/',
    'action' => [IndexController::class, 'registroAction'],
    'auth' => ['invitado']
));

$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
$route = $router->match($request);
$bandera = false;
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    foreach ($route['auth'] as $key) {
        if ($_SESSION['perfil'] === $key) {
            $bandera = true;
        }
    }
    if ($bandera) {
        $controller = new $controllerName;
        $controller->$actionName($request);
    } else {
        echo $_SESSION['perfil'];
        echo "No tienes permiso para acceder a esta pagina";
    }
} else {
    echo "No se encontro nada";
}

















?>