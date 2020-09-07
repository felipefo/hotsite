

function QuadroController(){
	
        this.hotsiteVisao = new HotsiteVisao();               
	this.persistencia= new PersistenciaQuadro();        	        
        var _this = this;
	this.atualizarLista =function(){	 	    		
	    _this.persistencia.listarTodos();						
	}
	this.atachListenerVisaoLoadAll= function(){             	    
		this.persistencia.listaListener.attach(function (sender, data) {						                                                             
        	_this.hotsiteVisao.carregarTudo(data);
                _this.hotsiteVisao.carregarMenu(data);
            }
        );

        }    
        this.editar =function(id){	 	    			                                
            _this.hotsiteVisao.editar(id);            
            
	}
        
         this.salvar =function(id){	 	    			                                
            var titulo = _this.hotsiteVisao.getTituloHtml(id);                        
            var html = _this.hotsiteVisao.getQuadroHtml(id); 
            var idOonly  = id.split('_html')[0];
            _this.persistencia.salvar(html, idOonly, titulo);//possar representar o meu
            
	}
        
        this.deletar =function(id){	 	    			                                
            var idOonly  = id.split('_html')[0];
            _this.persistencia.delete(idOonly);//possar representar o meu
            
	}
                     	
}



