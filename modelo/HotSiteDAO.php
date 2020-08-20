<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/MysqlConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/HotSite.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/UsuarioDAO.php";

class HotSiteDAO {

    //$dbuser = $_ENV['MYSQL_USER'];
    //$dbpass = $_ENV['MYSQL_PASS'];
    public $dbuser = 'root';
    public $dbpass = '';
    public $connection;

    public function HotSiteDAO() {
        $mysqlConnection = new MysqlConnection();
        $this->connection = $mysqlConnection->getConnection();
    }

    function removeByID($hotsite_id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM hotsite WHERE id  = ? ");
            $statement->bindValue(1, $hotsite_id);
            $statement->execute();
            if (!($statement->rowCount() > 0)) {
                http_response_code(404);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }
    
    
    function getByUrl($url) {
        try {
            $statement = $this->connection->prepare("SELECT hotsite.url, hotsite.id FROM hotsite"
                    . " where "
                    . " hotsite.url = ? limit 1");
            $statement->bindValue(1, $url);
            $statement->execute();
            $hotsites = $statement->fetchAll(PDO::FETCH_OBJ);

            $statement->closeCursor();
            if (sizeof($hotsites) == 0) {               
                throw new Exception("Nenhum hotiste encontrado");
            }
            $hotsite = new HotSite();          
            foreach ($hotsites as $record) {
                $hotsite->setUrl($record->url);
                $hotsite->setId($record->id);
                $quadroDAO  = new QuadroDAO();
                $quadros = $quadroDAO->getByHotsiteID($record->id);                                                    
                $hotsite->setQuadros($quadros);                                                                                              
            }
            return $hotsite;      
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }
    
    

    function getByUserID($usuario_id) {
        try {
            $statement = $this->connection->prepare("SELECT hotsite.url, hotsite.id FROM hotsite, usuario"
                    . " where "
                    . " usuario.hotsite_id  = hotsite.id and usuario.id = ?  ");
            $statement->bindValue(1, $usuario_id);
            $statement->execute();
            $hotsites = $statement->fetchAll(PDO::FETCH_OBJ);

            $statement->closeCursor();
            if (sizeof($hotsites) == 0) {
                http_response_code(404);
                throw new Exception("Nenhum hotiste encontrado");
            }
            $hotsite = new HotSite();
            foreach ($hotsites as $record) {
                $hotsite->setUrl($record->url);
                $hotsite->setId($record->id);
                $quadroDAO  = new QuadroDao();
                $quadros = $quadroDAO->getByHotsiteID($record->$id);                                                    
                $hotsite->setQuadros($quadros);                                                                                              
            }
            return $hotsite;
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    function save($hotsite) {
        try {
            $statement = $this->connection->prepare("INSERT INTO hotsite (url, usuario_id)
                                VALUES (?, ?);");
            $statement->bindValue(1, $hotsite->getUrl());
            $statement->bindValue(2, $hotsite->getUsuario()->getId());
            $response = $statement->execute();
            //var_dump($response);
            if (!($statement->rowCount() > 0)) {
                http_response_code(404);//TODO:rever esse tratamento de erro.
            }
            $hotsite->setId($this->connection->lastInsertId());
            return $hotsite;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
