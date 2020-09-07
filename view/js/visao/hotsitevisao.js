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
            htmlTitulo += '<a href="#' + key + '">' + titulo +"</a>";
        }
        
        htmlTitulo += '<a href="javascript:void(0)" onclick="document.getElementById(\'adicionar_modal\').style.display = \'block\'">Adicionar Quadro</a>';
        htmlTitulo += '<a href="javascript:void(0)" onclick="document.getElementById(\'login_modal\').style.display = \'block\'">Login</a>';
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
                    + '<a href="#editar" style="padding:10px;" onclick="controleQuadro.editar(\'' + id   +'_html\')"><i class="material-icons">edit</i></a>'
                    + '<a href="#editar" style="padding:10px;" onclick="controleQuadro.salvar(\'' + id  +'_html\')"><i class="material-icons">save</i></a>'
                    + '<a href="#editar" style="padding:10px;" onclick="controleQuadro.deletar(\'' + id + '_html\')"><i class="material-icons">delete</i></a>'
                    + '</div>'
                    + '<div  id="' + id + '_html">' + html + '</div>'
                    + '<input type="text" style="display:none;"id="' + id + '_html_titulo" value="' +  titulo + '"></input>'
                    + '<textarea  rows="20" cols="80" style="display:none;"id="' + id + '_html_textarea">' + html + '</textarea>'
                    + '</section>';
        }
        lista.innerHTML = htmlQuadro;
    };
    this.editar = function (id) {
        $('#' + id  ).attr('style', 'display:none');
        $('#' + id + '_textarea').attr('style', 'display:block');
        $('#' + id + '_titulo').attr('style', 'display:block');

    };


    this.getQuadroHtml = function (id) {
        var html  = $('#' + id + '_textarea').val();
        return html;
    };

    this.getTituloHtml = function (id) {
        var titulo =  $('#' + id + '_titulo').val();
        return titulo;
    };

}