

function HotsiteController(){
	
        this.hotsiteVisao = new HotsiteVisao();               
	this.persistencia= new  PersistenciaHotsite();        	        
        var _this = this;
	this.atualizarLista =function(){	 	    		
	    _this.persistencia.listarTodos();						
	}
	this.atachListenerVisaoLoadAll= function(){             	    
		_this.persistencia.listaListener.attach(function (sender, data) {						                                                             
        	_this.hotsiteVisao.carregarTudo(data);
                _this.hotsiteVisao.carregarMenu(data);
            }
        );

        }    
        this.editar =function(id){	 	    			                                
            _this.hotsiteVisao.editar(id);            
            
	}
        
         this.salvar =function(id){	 	    			                                
            var html = _this.hotsiteVisao.getHtml(id);                        
            var titulo = _this.hotsiteVisao.getHtml(id);                        
            _this.persistencia.salvar(html, titulo, id);//possar representar o meu
	}
                     	
}



