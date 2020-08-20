<?php 

 require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/IRouter.php";
 require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/Router.php";     
 require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/modelo/QuadroDAO.php";

  class QuadroService implements IRouter{
                             
    public function delete() {
        throw  new Exception("Não implementado ainda"); 
    }
    public function get() {                            
        if (isset($_GET['hotsite_id'])) {
           $hotsite_id  = $_GET['hotsite_id'];
           $quadroDAO =  new QuadroDAO();        
           $quadros = $quadroDAO->getByHotsiteID($hotsite_id);
           print json_encode($quadros);
        }else { 
            echo 'Missing hotsite id';
        }                                        
    }
    public function post() {
        throw  new Exception("Não implementado ainda"); 
    }
    public function put() {
       throw  new Exception("Não implementado ainda"); 

    }

}  
 $router = new Router(new QuadroService()); 
 $router->run();
  
?>