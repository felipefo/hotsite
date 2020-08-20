<?php

class MysqlConnection {

    //$dbuser = $_ENV['MYSQL_USER'];
    //$dbpass = $_ENV['MYSQL_PASS'];	
    public $dbuser = 'root';
    public $dbpass = '';
    public $con;

    function getConnection() {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=hotsite", $this->dbuser, 
                    $this->dbpass, array(PDO::ATTR_PERSISTENT => true));
            return $this->con;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
