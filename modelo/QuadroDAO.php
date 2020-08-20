<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Quadro.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/UsuarioDAO.php";
  
class QuadroDAO
 { 
	//$dbuser = $_ENV['MYSQL_USER'];
	//$dbpass = $_ENV['MYSQL_PASS'];
	public $dbuser = 'root';
	public $dbpass = '';
        public $connection;

        public function QuadroDAO(){                     
          $mysqlConnection  = new MysqlConnection();
          $this->connection  = $mysqlConnection->getConnection();            
        }
        
	function getByUserID($usuario_id) {				
		try {		                                                                
			$statement =  $this->connection->prepare("SELECT * FROM quadro where usuario_id = ? order by ordem");
			$statement->bindValue(1, $usuario_id);                        
                        $statement->execute();
			$quadros = $statement->fetchAll(PDO::FETCH_OBJ);                  
			$statement->closeCursor();
                        if(sizeof($quadros)  == 0 ) {
                            throw  new Exception("Nenhum quadro encontrado");
                        }
			$quadro = new Quadro();                       
			foreach ($quadros as $record ) {
			  $quadro->setHtml($record->html);
			  $quadro->setOrdem($record->ordem);				                          				
                          $quadro->setId($record->id);	
                          $hotsiteDAO  = new HotSiteDao();
                          $usuario = $usuarioDAO->getById($record->$usuario_id);
                          $quadro->setUsuario($usuario);                                                                              
			}		                        
			return $usuario;			
		} catch(PDOException $e) {
			echo $e->getMessage();
                        throw $e;
		}
	}	
        
        
        function getByHotsiteID($hotsite_id) {				
		try {		                                                                
			$statement =  $this->connection->prepare("SELECT * FROM quadro "
                                . " where hotsite_id =  ? order by ordem");
			$statement->bindValue(1, $hotsite_id);                        
                        $statement->execute();
			$quadros = $statement->fetchAll(PDO::FETCH_OBJ);                  
			$statement->closeCursor();
                        if(sizeof($quadros)  == 0 ) {
                            throw  new Exception("Nenhum quadro encontrado");
                        }
		        $listaDeQuadros=[];
			foreach ($quadros as $record ) {
                          $quadro = new Quadro();                       
			  $quadro->setHtml($record->html);
			  $quadro->setOrdem($record->ordem);				                          				
                          $quadro->setId($record->id);	                          
                          array_push($listaDeQuadros, $quadro);                             
			}		                        
			return $listaDeQuadros;			
		} catch(PDOException $e) {
			echo $e->getMessage();
                        throw $e;
		}
	}	
        
	function  get() {				
		try {
			$pdo = new PDO("mysql:host=localhost;dbname=hotsite", $this->dbuser, $this->dbpass);
			$statement = $pdo->prepare("SELECT * FROM user");
			$statement->execute();
			$posts = $statement->fetchAll(PDO::FETCH_OBJ);
			
			echo "<h2>Posts</h2>";
			echo "<ul>";
			foreach ($posts as $post ) {
				echo "<li>".$post->title."</li>";
			}
			echo "</ul>";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	
	function save(Usuario $usuario) {				
		try {
			$pdo = new PDO("mysql:host=mysql;dbname=hotsite", $this->dbuser, $this->dbpass);
			$statement = $pdo->prepare("SELECT * FROM user");
			$statement->execute();
			$posts = $statement->fetchAll(PDO::FETCH_OBJ);
			
			echo "<h2>Posts</h2>";
			echo "<ul>";
			foreach ($posts as $post ) {
				echo "<li>".$post->title."</li>";
			}
			echo "</ul>";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
} 