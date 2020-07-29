<?php
    session_start(); 
    if(isset($_GET['logout'])){
       session_destroy();
       echo "Voce foi deslogado";
    }else if(isset($_SESSION["LOGIN"])){
      echo "Voce esta logado";
      
    }
    else if(isset($_POST['login']) && $_POST['login'] == "admin" 
    && isset($_POST['senha']) && $_POST['senha'] == "admin"){
       $_SESSION["LOGIN"] = true; 
       $_SESSION["USER_NAME"] = $_POST['user'] ;
       echo "login ok";
       //header("Location: bemvindo.html");
    }else{
         header('HTTP/1.0 403 Forbidden');
         die('Voce nao esta logado' . $_SESSION["LOGIN"]);  
    }
?>