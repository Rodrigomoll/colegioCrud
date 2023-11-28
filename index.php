<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Controllers/LoginController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/AdminController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/ClasesController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/MaestrosController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/AlumnoController.php");




// ENRUTADOR
$loginController = new LoginController();
$adminController = new AdminController();
$clasesController = new ClasesController();
$maestrosController = new MaestrosController();
$alumnosController = new AlumnosController();


// Dividimos la ruta por el signo "?" para no leer los query params. Ejem: /clientes?id=1
$route = explode("?", $_SERVER["REQUEST_URI"]);

$method = $_SERVER["REQUEST_METHOD"];

$contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : null;

if ($method === "POST") {
    switch ($route[0]) {
        case '/login':
            $loginController->login($_POST["correo"], $contrasena);
            break;
        case '/permisos/delete':
            $adminController->delete($_POST["id"]);
            break;
        case '/permisos/update':
            $adminController->update($_POST);
            break;
        case '/clases/delete':
            $clasesController->delete($_POST["id"]);
            break;

        case '/clases/create':
            $clasesController->store($_POST);
            break;

        case '/clases/update':
            $clasesController->update($_POST);
            break;
        case '/maestros/delete':
            $maestrosController->delete($_POST["id"]);
            break;
        case '/maestros/create':
            $maestrosController->store($_POST);
            break;
        case '/maestros/update':
            $maestrosController->update($_POST);
            break;

        case '/alumnos/delete':
            $alumnosController->delete($_POST["id"]);
            break;
        case '/alumnos/create':
            $alumnosController->store($_POST);
            break;
        case '/alumnos/update':
            $alumnosController->update($_POST);
            break;
        default:
            echo "NO ENCONTRAMOS LA RUTA.";
            break;
    }
}

if ($method === "GET") {
    switch ($route[0]) {
        case '/index.php':
            $loginController->index();
            break;
        case '/dashboard':
            $loginController->dashboard();
            break;
        case '/logout':
            $loginController->logout();
            break;
        case '/permisos':
            $adminController->index();
            break;
        case '/permisos/edit':
            $adminController->edit($_GET["id"]);
            break;
        case '/clases':
            $clasesController->index();
            break;
        case '/clases/edit':
            $clasesController->edit($_GET["id"]);
            break;
        case '/clases/create':
            $clasesController->create();
            break;
        case '/maestros':
            $maestrosController->index();
            break;
        case '/maestros/edit':
            $maestrosController->edit($_GET["id"]);
            break;
        case '/maestros/create':
            $maestrosController->create();
            break;

        case '/alumnos':
            $alumnosController->index();
            break;
        case '/alumnos/edit':
            $alumnosController->edit($_GET["id"]);
            break;
        case '/alumnos/create':
            $alumnosController->create();
            break;
        default:
            echo "NO ENCONTRAMOS LA RUTA.";
            break;
    }
}
