<?php

    require $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Usuario.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/UsuarioDAO.php";
    try 
	{
    session_start(); 
    if(isset($_GET['logout'])){
       session_destroy();
       echo "Voce foi deslogado";
    }else if(isset($_SESSION["LOGIN"])){
      echo "Voce esta logado";
      
    }	
    else if(isset($_POST['login']) && isset($_POST['senha'])){		        	
	  
	  $usuarioDAO = new UsuarioDAO();
	   $usuario  =  $usuarioDAO->getByLogin($_POST['login']);
	   $autenticado  = $usuario->validar($senha, $login);
	   if($autenticado) {		
		  $_SESSION["LOGIN"] = true; 
          $_SESSION["USER_NAME"] = $_POST['login'] ;
          echo "login ok";
		  //header("Location: bemvindo.html");
	   }else{
          throw new Exception("Erro no login");
	   }
	}else throw new Exception("Erro no login");		
	
    }catch(Exception $e) {
		echo $e->getMessage();	
	}
	
?>