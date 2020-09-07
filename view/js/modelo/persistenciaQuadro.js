

jQuery.each( [ "delete" ], function( i, method ) {
  jQuery[ method ] = function( url, data, callback, type ) {
    if ( jQuery.isFunction( data ) ) {
      type = type || callback;
      callback = data;
      data = undefined;
    }

    return jQuery.ajax({
      headers: {
       'X-HTTP-Method-Override': method
      },  
      url: url,
      type: "post",
      dataType: type,
      data: data,
      success: callback
    });
  };
});


jQuery.each( [ "put" ], function( i, method ) {
  jQuery[ method ] = function( url, data, callback, type ) {
    if ( jQuery.isFunction( data ) ) {
      type = type || callback;
      callback = data;
      data = undefined;
    }

    return jQuery.ajax({
      headers: {
       'X-HTTP-Method-Override': method
      },  
      url: url,
      type: "post",
      dataType: type,
      data: data,
      success: callback
    });
  };
});

function PersistenciaQuadro() {

    this.domain = "http://localhost/hotsite/service/quadroservice.php";
    this.listaListener = new Event(this);
    this.lista = new Array();    
    _this  = this;
    this.listarTodos = function () {

        var url = window.location.href;
        var urlsplit = url.split("/");
        var path = urlsplit[urlsplit.length - 1];
        $.get('http://localhost/hotsite/service/hotsiteservice.php' + path, function (data, status) {
            _this.lista = JSON.parse(data);
            _this.lista = JSON.parse(data);
            _this.listaListener.notify(JSON.parse(data));
        });
    }
    
    
     this.delete = function (id) {        
        var json={};
        json['id'] = id;
        $.delete( this.domain, json)
    	    .done(function(msg){ 			        				                
                alert("Removido com sucesso");
                controle.atualizarLista();
             }
	    )
        .fail(function(xhr, status, error) {        
            alert(xhr.responseText);
	  }
        )
    }	    

    this.salvar = function (html, id, titulo) {        
        var json={};
        json['html'] = html;
        json['titulo'] = titulo;
        json['id'] = id;
        $.put( this.domain, json)
    	    .done(function(msg){ 			        				                
                alert("Atualizado com sucesso");
                controle.atualizarLista();
             }
	    )
        .fail(function(xhr, status, error) {        
            alert(xhr.responseText);
	  }
        )
    }	    
}

