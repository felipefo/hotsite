<?php

class UsuarioDAO
 { 
	//$dbuser = $_ENV['MYSQL_USER'];
	//$dbpass = $_ENV['MYSQL_PASS'];
	public $dbuser = 'root';
	public $dbpass = '';

	function getByLogin($login) {				
		try {
			$pdo = new PDO("mysql:host=localhost;dbname=hotsite", $this->dbuser, $this->dbpass);
			$statement = $pdo->prepare("SELECT * FROM usuario where login = ?");
			$statement->bindValue(1, $login);                        
                        $statement->execute();
			$usuarios = $statement->fetchAll(PDO::FETCH_OBJ);                  
			$statement->closeCursor();
                        if(sizeof($usuarios)  == 0 ) {
                            throw  new Exception("Nenhum usuario encontrado");
                        }
			$usuario = new Usuario();
                       // var_dump($usuarios);
			foreach ($usuarios as $record ) {
			  $usuario->setLogin($record->login);
			  $usuario->setSenha($record->senha);				
                          $usuario->setRole($record->role);
                          $usuario->setId($record->id);
			}			
			return $usuario;			
		} catch(PDOException $e) {
			echo $e->getMessage();
                        throw $e;
		}
	}	
	function  getById($usuario_id) {				
		try {
			$pdo = new PDO("mysql:host=localhost;dbname=hotsite", $this->dbuser, $this->dbpass);
			$statement = $pdo->prepare("SELECT * FROM user where usuario_id= ?");
			$statement->bindValue(1, $usuario_id);                        
                        $statement->execute();
			$usuarios = $statement->fetchAll(PDO::FETCH_OBJ);
                         if(sizeof($usuarios)  == 0 ) {
                            throw  new Exception("Nenhum usuario encontrado");
                        }
			$usuario = new Usuario();
                       // var_dump($usuarios);
			foreach ($usuarios as $record ) {
			  $usuario->setLogin($record->login);
			  $usuario->setSenha($record->senha);				
			}			
			return $usuario;	
			
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