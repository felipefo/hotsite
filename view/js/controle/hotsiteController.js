

function HotsiteController(){
	
	this.persistencia= new Persistencia();        	        
	this.atualizarLista =function(){	 	    		
	    this.persistencia.listarTodos();						
	}
	this.atachListenerVisaoLoadAll= function(){             	    
		this.persistencia.listaListener.attach(function (sender, data) {						                 
                var hotsiteVisao = new HotsiteVisao()                                     
        	hotsiteVisao.carregarTudo(data);
            }
        );
	}		
}



