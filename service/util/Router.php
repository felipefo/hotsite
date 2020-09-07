<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/util/IRouter.php";

/**
 * @author felipe
 */
class Router implements IRouter {
    public $class; //aberta a extensão e fechada a modificação        
    public function Router($class) {
        session_start();
        $this->class = $class;
    }   
    public function checkPermission($verbo){                                    
        if(isset($_SESSION["ROLE"])){               
           $role  = $_SESSION["ROLE"];
           $roles  = $this->class->role_validacao[$verbo];        
           if(!in_array($role, $roles)) {
               http_response_code(403);
               echo "Sem premissao para acessar esse recurso";
           }                              
           if(isset($_SESSION["ID"])){                            
               if(isset($this->class->$permission[$verbo])){                   
                   if(!($_SESSION["ID"]  === $_POST['id']) ) {
                       http_response_code(403);
                       echo "Sem premissao para acessar esse recurso";
                   } 
               }                   
           }
           else {               
               http_response_code(403);
               echo "Sem premissao para acessar esse recurso";
           }            
        }else {
             http_response_code(403);
             echo "Voce não esta logado";
        }                  
    }
        
    
    public function run() {                  
        if ($this->delete()) {
            return;
        } else if ($this->put()) {
            return;
        }else if ($this->get()) {
            return;
        } else if ($this->post()) {
            return;
        } 
    }

    public function get() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $this->class->get();
            return true;
        }
        return false;
    }

    //https://restfulapi.net/http-methods/#delete
    public function delete() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) 
                && $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] == 'delete') {
            $this->checkPermission('delete');
            $this->class->delete();
            return true;
        }
        return false;
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->checkPermission('post');
            $this->class->post();
            return true;
        }
        return false;
    }

    public function put() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) 
                && $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] === 'put') {
            $this->checkPermission('put');
            $this->class->put();
            return true;
        }
        return false;
    }

}
