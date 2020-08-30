function PersistenciaQuadro(persistencia) {

    this.domain = "http://localhost/hotsite/service/quadroservice.php";
    this.persistencia = persistencia;

    this.listarTodos = function () {

        var url = window.location.href;
        var urlsplit = url.split("/");
        var path = urlsplit[urlsplit.length - 1];
        $.get(this.domain + path, function (data, status) {
            persistencia.lista = JSON.parse(data);
            persistencia.listaListener.notify(JSON.parse(data));
        });
    }

    //TODO: TROCAR PELO OBJETO QUADRO
    this.salvar = function (html, id) {        
        var json=[];
        json['html'] = html;
        json[id] = id;
        $.post( this.domain, JSON.stringify(json)                                                )
    	    .done(function(msg){ 			        				
		_this.persistencia.lista = (msg);//guardando na lista
		_this.persistencia.listaListener.notify(msg); //enviando para os observadores  					
	  	alert("Criado com sucesso") }
	    )
        .fail(function(xhr, status, error) {        
            alert(xhr.responseText);
	  }
        )
	}	    
}

