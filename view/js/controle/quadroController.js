

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
            
             var titulo =  $('#modal_titulo').val();                        
            var html =  $('#modal_html').val();                        
            var id  = $('#modal_id_quadro').val();                        
            _this.persistencia.salvar(html, id, titulo);//possar representar o meu
            $('#editar_modal').hide();
            
	}
        
        this.deletar =function(id){	 	    			                                
            var idOonly  = id.split('_html')[0];
            _this.persistencia.delete(idOonly);//possar representar o meu
            
	}
                     	
}



