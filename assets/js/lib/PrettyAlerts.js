function PrettyAlerts () {

}

// Biblioteca para geração de alertas coloridos
PrettyAlerts.init = function() {
    // Definir configurações padrão
    this.type = "info";
    this.dismissable = true;
    this.message = "";

    this.alertId = 0;
}

// Mostar um alerta na tela
PrettyAlerts.show = function( options ) {
    // Pegar as opções do objeto que foi passado. Caso não tenham sido defindas,
    // utilizar os valores padrão
    var type = (typeof options.type !== 'undefined') ? options.type : this.type;
    var dismissable = (typeof options.dismissable !== 'undefined') ? options.dismissable : this.dismissable;
    var message = (typeof options.message !== 'undefined') ? options.message : this.message;
    var timeout = options.timeout || 3000;

    // Construir o html do alerta
    this.alertId++;
    var template = "<div id=\"alert" + this.alertId + "\" class=\"alert ";
    template += "alert-" + type;
    if (dismissable == true)
        template += " alert-dismissable";
    template += "\" role=\"alert\">";
    if (dismissable == true)
        template += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
    template += message;
    template += "</div>";

    // Testar se já existe um .alert-container na página. Caso não exista, criar um.
    var $ac = $(".alert-container");
    if ($ac.length == false ) {
        $ac = $("<div class=\"alert-container\"></div>");
        $("body").append($ac);
    } else {
        $ac.empty();
    }

    // Adicionar o html do alert à página
    $tmp = $(template);
    $ac.append($tmp);
    PrettyAlerts.setTimeout($tmp, timeout);
}

PrettyAlerts.setTimeout = function($tmp, timeout) {
    setTimeout(function(){
        $tmp.remove();
    }, timeout);
}

module.exports = PrettyAlerts
