<?php
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';
require_once './libs/response.php';
require_once './app/controllers/aerolineas.controllers.php';
require_once './app/controllers/personas.controllers.php';
require_once './app/controllers/auth.controllers.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listar';
    if (!empty( $_GET['action'])) {
        $action = $_GET['action'];
    }

$params = explode('/', $action);

switch($params[0]){
    case 'listar':
        sessionAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller2 = new personasControllers($res);
        $controller->showListarAerolineas($controller2);
        break;
    case 'listaraerolinea':
        sessionAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller->showAerolineas();
        break;
    case 'detallesaerolinea':
        sessionAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller2 = new personasControllers($res);
        $models = $controller2-> showPersonasid($params[1]);
        $controller->showAerolineaDetails($params[1], $models); // El segundo parámetro es el ID de la fábrica
        break;
    case 'showAddAerolinea':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller -> ListaaddAero();
        break; 
    case 'addAerolinea':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller -> addAero();
        break;
    case 'deleteAerolinea':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller-> deleteFab($params[1]);
        break;
    case 'showEditAerolinea':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller->showEditAerolinea($params[1]); 
        break;
    case 'editAerolinea':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new aerolineasControllers($res);
        $controller->editAero($params[1]);
        break;

        ///////////////////////////////////////////////

    case 'listarpersona':
        sessionAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller -> showPersonas();
        break;
    case 'detallespersona':
        $controller = new personasControllers($res);
        $controller2 = new aerolineasControllers($res);
        $persona = $controller->getPersona($params[1]);
        $id_aerolinea = $persona->id_aerolinea;
        $aerolinea = $controller2-> showAerolineasid($id_aerolinea);
        $controller->showPersonaDetails($params[1], $aerolinea);
        break;
    case 'showAddPersona':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller2 = new aerolineasModels($res);
        $modelsAerolinea = $controller2 -> getAllAerolineas();
        $controller->listaaddPersona($modelsAerolinea);
        break;
    case 'addPersona':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller->addPersona();
        break;
    case 'deletePersona':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller-> deletePersona($params[1]);
        break;
    case 'showEditPersona':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller2 = new aerolineasModels($res);
        $aerolineas = $controller2->getAerolineas();
        $controller->showEditAerolinea($params[1], $aerolineas);
        break;
    case 'editPersona':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new personasControllers($res);
        $controller->editPersona($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthControllers();
        $controller -> showLogin();
        break;
    case 'login':
        $controller = new AuthControllers();
        $controller -> login();
        break;
    case 'logout':
        $controller = new AuthControllers();
        $controller->logout();
        break;
    default:
        echo '404 Page Not Found';
        break;
}