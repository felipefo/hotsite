

function HotsiteController(){
	
        this.hotsiteVisao = new HotsiteVisao();        
        _this = this;
	this.persistencia= new Persistencia();        	        
	this.atualizarLista =function(){	 	    		
	    this.persistencia.listarTodos();						
	}
	this.atachListenerVisaoLoadAll= function(){             	    
		this.persistencia.listaListener.attach(function (sender, data) {						                                                             
        	_this.hotsiteVisao.carregarTudo(data);
            }
        );

        }    
        this.editar =function(id){	 	    			                                
            _this.hotsiteVisao.editar(id);            
            
	}
        
         this.salvar =function(id){	 	    			                                
            var html = _this.hotsiteVisao.getHtml(id);                        
            this.persistencia.salvar(html, id);//possar representar o meu
	}
                     	
}



