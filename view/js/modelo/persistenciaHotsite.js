function PersistenciaHotsite() {

    this.domain = "http://localhost/hotsite/service/hotsiteservice.php";    
    this.listaListener = new Event(this);
    this.lista = new Array();
    var _this= this;

    this.listarTodos = function () {

        var url = window.location.href;
        var urlsplit = url.split("/");
        var path = urlsplit[urlsplit.length - 1];

        $.get(this.domain + path, function (data, status) {
            _this.lista = JSON.parse(data);
            _this.listaListener.notify(JSON.parse(data));
        });
    }

    //TODO: TROCAR PELO OBJETO QUADRO
    this.salvar = function (html, id){        
        var json=[];
        json['html'] = html;
        json[id] = id;
        $.post( this.domain, JSON.stringify(json)                                                )
    	    .done(function(msg){ 			        				
		_this.lista = (msg);//guardando na lista
		_this.listaListener.notify(msg); //enviando para os observadores  					
	  	alert("Criado com sucesso");
            }
	    )
        .fail(function(xhr, status, error) {        
            alert(xhr.responseText);
	  }
        )
	}	    
}

