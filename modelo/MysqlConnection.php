<?php

class MysqlConnection
 {

	//$dbuser = $_ENV['MYSQL_USER'];
	//$dbpass = $_ENV['MYSQL_PASS'];
	public $dbuser = '';
	public $dbpass = '';

	function connect() {				
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

