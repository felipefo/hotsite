function HotsiteVisao() {

    this.limparTudo = function () {
        var lista = document.getElementById("listaquadros");
        lista.innerHTM = "";

    }

    this.carregarTudo = function (quadros) {
        var lista = document.getElementById("listaquadros");
        lista.innerHTML = "";
        console.log(quadros);
        var htmlQuadro = "";
        var sections = quadros['quadros'];

        for (var key in sections) {
            var html = sections[key]['html'];
            var section = "sectionimpar";
            if (key % 2 == 0)
                var section = "sectionpar";

            htmlQuadro += '<section id="' + key + '" class="' + section + '">'
                    + '<div style="height:20px;padding:5px;">'
                    + '<a href="#editar" style="padding:10px;" onclick="controle.editar('+ key +')"><i class="material-icons">edit</i></a>'
                    + '<a href="#editar" style="padding:10px;" onclick="controle.salvar('+ key +')"><i class="material-icons">save</i></a>'
                    + '<a href="#editar" style="padding:10px;" onclick="controle.editar('+ key +')"><i class="material-icons">delete</i></a>'
                    + '</div>'                   
                    + '<div  id="' + key + '_html">' + html + '</div>'
                    + '<textarea  rows="20" cols="80"style="display:none;"id="' + key + '_html_textarea">' + html + '</textarea>'
                    + '</section>';
        }
        lista.innerHTML = htmlQuadro;
    }
    this.editar = function (id) {        
        $('#'+id + '_html').attr('style' , 'display:none');
        $('#'+id +  '_html_textarea').attr('style' , 'display:block');
    }
    
    this.getHtml = function (id) {               
        return $('#'+id +  '_html_textarea').val();
    }
    

}