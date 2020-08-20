function PersistenciaHotsite(persistencia) {

    this.domain = "http://localhost/hotsite/service/hotsiteservice.php";
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

}
;
