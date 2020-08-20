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
                    + ' <h2>Titulo</h2>'
                    + html
                    + '</section>';
       }
        lista.innerHTML = htmlQuadro;
    }

}