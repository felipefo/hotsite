<?php

require $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/Usuario.php";
require $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/UsuarioDAO.php";

try {
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        echo "Voce foi deslogado";
    } else if (isset($_SESSION["LOGIN"])) {
        echo "role:" .  $_SESSION["ROLE"] . "<br>";
        echo "Voce esta logado";
    } else if (isset($_POST['login']) && isset($_POST['senha'])) {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getByLogin($_POST['login']);       
        $role = $usuario->validar($_POST['login'], $_POST['senha']);
        $_SESSION["LOGIN"] = true;
        $_SESSION["USER_NAME"] = $_POST['login'];
        $_SESSION["ROLE"] = $role;
        $_SESSION["ID"] = $usuario->getId();
        echo "role:" .  $_SESSION["ROLE"] . "<br>" . $role;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>