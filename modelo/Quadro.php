<?php

class Quadro {
    
    public $html;
    public $ordem;
    public $hotsite;
    public $id;
    
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
