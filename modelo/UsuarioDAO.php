<?php

class UsuarioDAO
 { 
	//$dbuser = $_ENV['MYSQL_USER'];
	//$dbpass = $_ENV['MYSQL_PASS'];
	$dbuser = 'admin';
	$dbpass = 'eUa1oj4vQZfH';

	function getByLogin($login) {				
		try {
			$pdo = new PDO("mysql:host=mysql;dbname=hotsite", $dbuser, $dbpass);
			$statement = $pdo->prepare("SELECT * FROM usuario where login =" . $login);
			$statement->execute();
			$usuarios = $statement->fetchAll(PDO::FETCH_OBJ);
			$statement->closeCursor();
			$usuario = new Usuario();
			foreach ($usuarios as $record ) {
				echo "<li>".$record->login."</li>";				
				$usuario->setLogin($record->login);
				$usuario->setSenha($record->senha);				
			}			
			return $usuario;			
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}	
	function get() {				
		try {
			$pdo = new PDO("mysql:host=mysql;dbname=hotsite", $dbuser, $dbpass);
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
	
	
	function save(Usuario usuario) {				
		try {
			$pdo = new PDO("mysql:host=mysql;dbname=hotsite", $dbuser, $dbpass);
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