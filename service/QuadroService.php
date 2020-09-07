<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/IRouter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/Router.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/QuadroDAO.php";

class QuadroService implements IRouter {

    public function delete() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $quadroDAO = new QuadroDAO();
            $quadros = $quadroDAO->removeById($id);
        }
        //else if (isset($_GET['html']) && isset($_GET['titulo']) &&){ 
        else {
            http_response_code(400);
            var_dump($_SERVER['html']);
            //throw  new Exception("Missing arguments");
        }
        //}
    }

    public function get() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $quadroDAO = new QuadroDAO();
            //$quadros = $quadroDAO->update($hotsite_id);
            //print json_encode($quadros);
        } else if (isset($_GET['url'])) {
            $hotsite_url = $_GET['url'];
            $quadroDAO = new QuadroDAO();
            $quadros = $quadroDAO->getByHotsiteURL($hotsite_url);
            print json_encode($quadros);
        }
    }

    public function post() {
        if (isset($_POST['html']) && isset($_POST['titulo'])) {
            $html = $_POST['html'];
            $titulo = $_POST['titulo'];
            $quadro = new Quadro();
            $quadro->setTitulo($titulo);
            $quadro->setHtml($html);                        
            //pegar url e usuario.
            $quadroDAO = new QuadroDAO();
            $quadros = $quadroDAO->salvar($quadro);
        }
        //else if (isset($_GET['html']) && isset($_GET['titulo']) &&){ 
        else {
            http_response_code(400);
            throw new Exception("Missing arguments");
        }



        //}
    }

    public function put() {

        if (isset($_POST['id']) && isset($_POST['html']) && isset($_POST['titulo'])) {
            $html = $_POST['html'];
            $titulo = $_POST['titulo'];
            $id = $_POST['id'];
            $quadro = new Quadro();
            $quadro->setTitulo($titulo);
            $quadro->setId($id);
            $quadro->setHtml($html);
            $quadroDAO = new QuadroDAO();
            $quadros = $quadroDAO->update($quadro);
        }
        //else if (isset($_GET['html']) && isset($_GET['titulo']) &&){ 
        else {
            http_response_code(400);
           throw  new Exception("Missing arguments");
        }
        //}
    }

}

$router = new Router(new QuadroService());
$router->run();
?>