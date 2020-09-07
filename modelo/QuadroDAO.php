<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/MysqlConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Quadro.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/UsuarioDAO.php";

class QuadroDAO {

    //$dbuser = $_ENV['MYSQL_USER'];
    //$dbpass = $_ENV['MYSQL_PASS'];
    public $dbuser = 'root';
    public $dbpass = '';
    public $connection;

    public function QuadroDAO() {
        $mysqlConnection = new MysqlConnection();
        $this->connection = $mysqlConnection->getConnection();
    }

    function getByUserID($usuario_id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM quadro where usuario_id = ? order by ordem");
            $statement->bindValue(1, $usuario_id);
            $statement->execute();
            $quadros = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();
            if (sizeof($quadros) == 0) {
                throw new Exception("Nenhum quadro encontrado");
            }
            $quadro = new Quadro();
            foreach ($quadros as $record) {
                $quadro->setHtml($record->html);
                $quadro->setOrdem($record->ordem);
                $quadro->setId($record->id);
                $quadro->setTitulo($record->titulo);
                $hotsiteDAO = new HotSiteDao();
                $usuario = $usuarioDAO->getById($record->$usuario_id);
                $quadro->setUsuario($usuario);
            }
            return $usuario;
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }
    
    
    function removeById($id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM quadro where id  =  ? ");
            $statement->bindValue(1, $id);
            $statement->execute();
            $quadros = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();                        
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    function getByHotsiteURL($url) {
        try {
            $statement = $this->connection->prepare("SELECT titulo, id, html, ordem FROM hotsite, quadro "
                    . " where hotsite.url  =  ? and hotsite.id = quadro.hotsite_id order by ordem");
            $statement->bindValue(1, $url);
            $statement->execute();
            $quadros = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();
            if (sizeof($quadros) == 0) {
                throw new Exception("Nenhum quadro encontrado");
            }
            $listaDeQuadros = [];
            foreach ($quadros as $record) {
                $quadro = new Quadro();
                $quadro->setHtml($record->html);
                $quadro->setOrdem($record->ordem);
                $quadro->setId($record->id);
                $quadro->setTitulo($record->titulo);
                array_push($listaDeQuadros, $quadro);
            }
            return $listaDeQuadros;
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    function getByHotsiteID($hotsite_id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM quadro "
                    . " where hotsite_id =  ? order by ordem");
            $statement->bindValue(1, $hotsite_id);
            $statement->execute();
            $quadros = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();
            if (sizeof($quadros) == 0) {
                throw new Exception("Nenhum quadro encontrado");
            }
            $listaDeQuadros = [];
            foreach ($quadros as $record) {
                $quadro = new Quadro();
                $quadro->setHtml($record->html);
                $quadro->setOrdem($record->ordem);
                $quadro->setId($record->id);
                $quadro->setTitulo($record->titulo);
                array_push($listaDeQuadros, $quadro);
            }
            return $listaDeQuadros;
        } catch (PDOException $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    function get() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=hotsite", $this->dbuser, $this->dbpass);
            $statement = $pdo->prepare("SELECT * FROM user");
            $statement->execute();
            $posts = $statement->fetchAll(PDO::FETCH_OBJ);

            echo "<h2>Posts</h2>";
            echo "<ul>";
            foreach ($posts as $post) {
                echo "<li>" . $post->title . "</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    function salvar(Quadro $quadro) {
        try {
            $statement = $this->connection->prepare
                    ("INSERT INTO hotsite (titulo, html)
                                VALUES (?, ?);");
            $statement->bindValue(1, $quadro->getTitulo());
            $statement->bindValue(2, $quadro->getHtml());            
            $result = $statement->execute();
            //return $statement->rowCount();                      
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function update(Quadro $quadro) {
        try {
            $statement = $this->connection->prepare
                    ("update quadro set titulo=?, html=? "
                    . " where id= ?");
            $statement->bindValue(1, $quadro->getTitulo());
            $statement->bindValue(2, $quadro->getHtml());
            $statement->bindValue(3, $quadro->getId());
            $result = $statement->execute();
            //return $statement->rowCount();                      
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
