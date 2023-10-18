<?php
require_once './app/views/auth.view.php';
require_once './app/models/login.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $user = $_POST['user'];
        $password = $_POST['password'];

        if (empty($user) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByUser($user);
        if ($user && password_verify($password, $user->password)) {
            // ACA LO AUTENTIQUE
            
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }

    public function showHome()
    {
        $title = "Home Page";
        require './templates/header.phtml';
        require './templates/home.phtml';
        require './templates/footer.phtml';
    }
    public function showOrders()    {
        $title = "Pedidos";
        require './templates/header.phtml';
        require './templates/orders.phtml';
        require './templates/footer.phtml';
    }
}
