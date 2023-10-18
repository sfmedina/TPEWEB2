<?php
require './config.php';

class UserModel {
    private $db;
    function __construct() {
        $this->db = new PDO('mysql:host='. DBURL .';dbname='. MYSQL_DB .';charset=utf8', DBROOT, DBPASS);
    }
    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM user WHERE user = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>


?>