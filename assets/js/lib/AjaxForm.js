
function AjaxForm() {

}


AjaxForm.init = function(form) {
    var $forms = $(form);
    if(!$forms.length) {
        return;
    }

    $alert = $("#ajaxFormAlert");
    $alert.find('#alert-close').one(function(){
        $alert.hide();
    });

    $forms.submit(function(){
        var $f = $(this);
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        var data;

        var ajaxConfig = {
            url: action,
            method: method,
            success: function (response) {
                var a = $f.trigger('ajaxForm:submitSuccess', [response]);
            },
            error: function (jqXHR) {
                res = jqXHR.responseJSON;
                $f.trigger('ajaxForm:submitError', [res]);
            },
            dataType: 'json'
        };

        if ($(this).attr('enctype') === 'multipart/form-data') {
            ajaxConfig.contentType = false;
            ajaxConfig.processData = false;
            data = new FormData(this);
        } else {
            data = $(this).serialize();
        }

        ajaxConfig.data = data;
        $.ajax(ajaxConfig);

        return false;
    });
}

module.exports = AjaxForm;
