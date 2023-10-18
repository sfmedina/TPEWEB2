<?php
require_once './config.php';


 class orderModel {
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host='. DBURL .';dbname='. MYSQL_DB .';charset=utf8', DBROOT, DBPASS);
    }    
    
    
    public function getOrders() {
        $query = $this->db->prepare('SELECT * FROM pedidos');
        $query->execute();
        
        $orders = $query->fetchAll(PDO::FETCH_OBJ);

        return $orders;
    }

    function addOrder($id_cliente, $fecha_pedido, $estado) {
        $query = $this->db->prepare('INSERT INTO pedidos (id_cliente, fecha_pedido, estado) VALUES(?,?,?)');
        $query->execute([$id_cliente, $fecha_pedido, $estado]);

        return $this->db->lastInsertId();
    }
    
    function deleteOrder($id) {
        $query = $this->db->prepare('DELETE FROM pedidos WHERE id = ?');
        $query->execute([$id]);
    }
    
    function updateOrder($status,$id ) {    
        $query = $this->db->prepare('UPDATE pedidos SET estado = ? WHERE id = ?');
        $query->execute([$status,$id]);
    }

        
    
}


?>