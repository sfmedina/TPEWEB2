<?php

class ordersView {
    public function showOrders($orders) {
        $count = count($orders);
        
        require 'templates/header.php';
        require './templates/orders.phtml';        
        require 'templates/footer.php';
        
    }
    public function showError($error) {
        require 'templates/header.php';
        
         return $error; 
        
        
        require 'templates/footer.php';
    }
}