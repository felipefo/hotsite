function Persistencia(){
	
        this.listaListener = new Event(this);
	this.lista = new Array();
        this.storage = new PersistenciaHotsite(this);	
	
	
	this.listarTodos =  function(){	
	    this.lista=new Array();
	    this.storage.listarTodos();
	}	
	
        this.salvar =  function(html, id){		    
	    this.storage.salvar();
	}	
	
}