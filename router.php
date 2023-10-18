<?php
require_once './app/controllers/orders.controller.php';
//require_once './app/controllers/about.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// listar    ->         taskController->showTasks();
// agregar   ->         taskController->addTask();
// eliminar/:ID  ->     taskController->removeTask($id); 
// finalizar/:ID  ->    taskController->finishTask($id);
// about ->             aboutController->showAbout();
// login ->             authContoller->showLogin();
// logout ->            authContoller->logout();
// auth                 authContoller->auth(); // toma los datos del post y autentica al usuario

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
     
    case 'orders':
        $controller = new AuthController();
        $controller->showOrders();
        break;

    case 'addOrder':
        $controller = new OrderController();
        $controller->addOrder();
        break;

    case 'deleteOrder':
        $controller = new OrderController();
        $controller->removeOrder($id);
        break;

    case 'changeOrder':
        $controller = new OrderController($id);
        $controller->changeOrder($id);
        break;        

    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;

    case 'home':
        $controller = new AuthController();
        $controller->showHome(); 
        break;

    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}