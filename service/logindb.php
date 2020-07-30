<?php

    require "Usuario.php";
	require "UsuarioDAO.php";
	
		
    session_start(); 
    if(isset($_GET['logout'])){
       session_destroy();
       echo "Voce foi deslogado";
    }else if(isset($_SESSION["LOGIN"])){
      echo "Voce esta logado";
      
    }
    else if(isset($_POST['login']) && isset($_POST['senha'])){
				
	   usuarioDAO = new  UsuarioDAO();
	   $usuario  = usuarioDAO->getByLogin($_POST['login']);
	   $autenticado  = $usuario->validar($senha, $login);
	   if($autenticado) {		
		  $_SESSION["LOGIN"] = autenticado; 
          $_SESSION["USER_NAME"] = $_POST['user'] ;
          echo "login ok";
		  //header("Location: bemvindo.html");
	   }else{
         header('HTTP/1.0 403 Forbidden');
         die('Voce nao esta logado' . $_SESSION["LOGIN"]);  
		}
    }else{
         header('HTTP/1.0 403 Forbidden');
         die('Voce nao esta logado' . $_SESSION["LOGIN"]);  
    }
?>