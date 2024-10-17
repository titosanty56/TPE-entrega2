<?php

require_once './app/controllers/aerolineas.controllers.php';
require_once './app/controllers/personas.controllers.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar';
    if (!empty( $_GET['action'])) {
        $action = $_GET['action'];
    }

$params = explode('/', $action);

switch($params[0]){
    case 'listar':
        //frodo los modifique pero nose si esta bien
    
        $controller = new aerolineasControllers();
        $controller->showAerolineas();
        $controller2 = new personasControllers();
        $controller2 -> showPersonas();
        break;
    case 'detallesaerolineas':
        $controller = new aerolineasControllers();
        $controller->showAerolineaDetails($params[1]); // El segundo parámetro es el ID de la fábrica
            break;
    case 'detallesmodelo':
        $controller = new modelosControllers();
        $controller -> showModeloDetails($params[1]);
            break;
}
// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

//require_once 'libs/response.php';
//require_once 'app/middlewares/session.auth.middleware.php';
//require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/task.controllers.php';
require_once 'app/controllers/auth.controllers.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// listar  -> TaskController->showTask();
// nueva  -> TaskController->addTask();
// eliminar/:ID  -> TaskController->deleteTask($id);
// finalizar/:ID -> TaskController->finishTask($id);
// ver/:ID -> TaskController->view($id); COMPLETAR

switch ($params[0]) {
    case 'listar':
        sessionAuthMiddleware($res);
        $controller = new TaskController($res);
        $controller->showTasks();
        break;
    case 'nueva':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new TaskController($res);
        $controller->addTask();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new TaskController($res);
        $controller->deleteTask($params[1]);
        break;
    case 'finalizar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new TaskController($res);
        $controller->finishTask($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
?>
