<?php
require_once './app/models/orders.model.php';
require_once './app/views/orders.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/controllers/auth.controller.php';

class OrderController {
    private $model;
    private $view;

    public function __construct() {
        // verifico logueado
        AuthHelper::verify();

        $this->model = new orderModel();
        $this->view = new ordersView();
    }

    public function showOrders() {
        // obtengo tareas del controlador
        $orders = $this->model->getOrders();
        
        // muestro las tareas desde la vista
        $this->view->showOrders($orders);
    }

    public function addOrder() {

        // obtengo los datos del usuario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];

        // validaciones
        if (empty($title) || empty($priority)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->addOrder($title, $description, $priority);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }

    function removeOrder($id) {
        $this->model->deleteOrder($id);
        header('Location: ' . BASE_URL);
    }
    
    function finishOrder($id) {
        $this->model->updateOrder($id,$_COOKIE);
        header('Location: ' . BASE_URL);
    }
    public function changeOrder($id) {
        // obtengo tareas del controlador
        
    }

}