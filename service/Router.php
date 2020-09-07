<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/hotsite/service/IRouter.php";

/**
 * @author felipe
 */
class Router implements IRouter {

    public $class; //aberta a extensão e fechada a modificação        

    public function Router($class) {
        $this->class = $class;
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
            $this->class->delete();
            return true;
        }
        return false;
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->class->post();
            return true;
        }
        return false;
    }

    public function put() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) 
                && $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] === 'put') {
            $this->class->put();
            return true;
        }
        return false;
    }

}
