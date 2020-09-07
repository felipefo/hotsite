<?php

class Quadro {
    
    public $html;
    public $ordem;
    public $hotsite;
    public $id;
    public $titulo;
       
    
    public function setHtml($html) {
        $this->html = $html;
    }
    public function setOrdem($ordem) {
        $this->ordem = $ordem;
    } 
    
    public function setId($id) {
        $this->id = $id;
    } 
    
    public function setHosite($hotsite) {
        $this->hotsite = $hotsite;
    }    
    
    public function getId() {
        return $this->id;
    }
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

        
    public function getHtml() {
        return $this->html;
    }
    public function getOrdem() {
        return $this->ordem;
    }        
    public function getHosite() {
        return $this->hotsite;
    }    
    
}
?>
