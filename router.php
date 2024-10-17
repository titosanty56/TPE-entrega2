<?php

require_once './app/controllers/aerolineas.controllers.php';
require_once './app/controllers/personas.controllers.php';
//require_once 'libs/response.php';
//require_once 'app/middlewares/session.auth.middleware.php';
//require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/auth.controllers.php';


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
