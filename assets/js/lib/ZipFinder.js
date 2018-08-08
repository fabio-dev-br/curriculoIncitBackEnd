

function ZipFinder() {

}

ZipFinder.init = function(zipContainer) {
    var zipContainer = zipContainer || '.zipContainer';

    $(zipContainer).on('keyup', '.zipCode', function(e){
        var $zipCode = $(this);
        var $container = $zipCode.closest(zipContainer);
        var zip = $(this).val().replace(/\D/g, '');
        if (zip.length < 8)
            return;

        $.get("https://apps.widenet.com.br/busca-cep/api/cep.json", {code: zip},
            function (result) {

                if (parseInt(result.status) !== 1) {
                    // alert(result.message || "Houve um erro desconhecido");
                    return;
                }

                $container.find(".zipCode").val(result.code);
                $container.find(".zipState").val(result.state);
                $container.find(".zipCity").val(result.city);
                $container.find(".zipNeigh").val(result.district);
                $container.find(".zipAddr").val(result.address);

                setTimeout(function(){
                    $zipCode.change();
                }, 200);

                $zipCode.closest('.talent-form-validator').trigger('formValidator:revalidate');
        });
    });
};

module.exports = ZipFinder;
