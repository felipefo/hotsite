
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/HotSite.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/Router.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/IRouter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/HotSiteDAO.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/QuadroDAO.php";

//padrao de projetos strategy   
class HotSiteService implements IRouter {

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $hotsiteDAO = new HotSiteDAO();
            $hotsites = $hotsiteDAO->removeById($id);
        } else {
            echo 'Missing hotsite id';
        }
    }

    public function get() {

        try {
            if (isset($_GET['usuario_id'])) {
                $usuario_id = $_GET['usuario_id'];
                $hotsiteDAO = new HotSiteDAO();
                $hotsites = $hotsiteDAO->getByUserID($usuario_id);
                print json_encode($hotsites);
            } else if (isset($_GET['url'])) {
                $url = $_GET['url'];
                $hotsiteDAO = new HotSiteDAO();
                $hotsite = $hotsiteDAO->getByUrl($url);
                print json_encode($hotsite);
            } else {
                http_response_code(400);
            }
        } catch (Exception $e) {
            http_response_code(404);
            print $e;
        }
    }

    public function post() {

        if (isset($_POST['usuario_id']) && isset($_POST['url'])) {
            $usuario_id = $_POST['usuario_id'];
            $url = $_POST['url'];
            $hotsiteDAO = new HotSiteDAO();
            $hotsite = new HotSite();
            $hotsite->setUrl($url);
            $usuario = new Usuario();
            $usuario->setId($usuario_id);
            $hotsite->setUsuario($usuario);
            $hotsites = $hotsiteDAO->save($hotsite);
            $json = [];
            $json['url'] = $hotsites->getUrl();
            $json['id'] = $hotsites->getId();


            print json_encode($json);
        } else {
            echo 'Missing user id';
        }
    }

    public function put() {
        throw new Exception("Não implementado ainda");
    }

}

header("Access-Control-Allow-Origin: *");

$router = new Router(new HotSiteService());
$router->run();
?>