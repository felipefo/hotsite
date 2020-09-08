function HotsiteVisao() {

    this.limparTudo = function () {
        var lista = document.getElementById("listaquadros");
        lista.innerHTM = "";

    };

    this.carregarMenu = function (quadros) {
        var lista = document.getElementById("mySidenav");
        lista.innerHTML = "";
        console.log(quadros);
        var htmlTitulo = '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
        var sections = quadros['quadros'];
        for (var key in sections) {
            var titulo = sections[key]['titulo'];
            htmlTitulo += '<a href="#' + key + '">' + titulo + "</a>";
        }

        htmlTitulo += '<a href="javascript:void(0)" onclick="document.getElementById(\'adicionar_modal\').style.display = \'block\'">Adicionar Quadro</a>';
        htmlTitulo += '<a href="javascript:void(0)" onclick="document.getElementById(\'login_modal\').style.display = \'block\'">Login</a>';
        htmlTitulo += '<a href="/hotsite/service/logindb.php?logout">Logout</a>';


        lista.innerHTML = htmlTitulo;
    };


    this.carregarTudo = function (quadros) {
        var lista = document.getElementById("listaquadros");
        lista.innerHTML = "";
        console.log(quadros);
        var htmlQuadro = "";
        var sections = quadros['quadros'];

        for (var key in sections) {
            var html = sections[key]['html'];
            var titulo = sections[key]['titulo'];
            var id = sections[key]['id'];
            var section = "sectionimpar";
            if (key % 2 == 0)
                var section = "sectionpar";

            htmlQuadro += '<section id="' + id + '" class="' + section + '">'
                    + '<div style="height:20px;padding:5px;">'
                    + '<a href="#editar" style="padding:10px;" onclick="controleQuadro.editar(\''+ id + '\')"><i class="material-icons">edit</i></a>'
                    + '<a href="#editar" id="' + id + '_editar"  style="padding:10px;" onclick="controleQuadro.deletar(\'' + id + '_html\')"><i class="material-icons">delete</i></a>'
                    + '</div>' 
                    + '<input type="hidden" id="' + id + 'titulo" value="'+  titulo + '"</input>'
                    + '<div  id="' + id + '_html">' + html + '</div>'+
                    '</section>';
        }
        lista.innerHTML = htmlQuadro;
    };
    this.editar = function (id) {

        var titulo =  $('#'  + id +'titulo').val();
        var html =  $('#'  + id +'_html').html();
        $('#modal_id_quadro').val(id);
        $('#modal_html').val(html);
        $('#modal_titulo').val(titulo);
        $('#editar_modal').attr('style', 'display:block');

    };




    this.getQuadroHtml = function (id) {
        var html = $('#' + id).html();
        return html;
    };

    this.getTituloHtml = function (id) {
        id_   =id.split('_html')[0];
        var titulo = $('#' + id_).html();
        return titulo;
    };

}