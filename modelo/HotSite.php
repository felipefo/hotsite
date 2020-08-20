<?php

class HotSite{
    
    public $url;
    public $id;
    public $usuario;     
   
    public $quadros;
    
    public function setUrl($url) {
        $this->url = $url;
    }
         
    public function setHosite($hotsite) {
        $this->hotsite = $hotsite;
    }    
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }  
    
    public function setQuadros($quadros) {
        $this->quadros = $quadros;
    }  
    
    public function addQuadro($quadro) {        
        array_push($this->quadros, $quadro);        
    }        
    
    public function setId($id) {
        $this->id = $id;
    } 
    
    public function getId() {
        return $this->id;
    }
     public function getQuadros() {        
        return $this->$quadros;        
    }
    
    public function getUsuario() {
        return $this->usuario;
    }
    
    public function getUrl() {
        return $this->url;
    }
        
    public function getHosite() {
        return $this->hotsite;
    }    
    
}
?>
