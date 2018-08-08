
function FormFiller() {

}


FormFiller.prefillForm = function($form, d) {

    $.each(d, function(key, value){
        var $ctrl = $('[name='+key+']', $form);

        if($ctrl.is('select')){
            $("option",$ctrl).each(function(){
                if (this.value==value) { this.selected=true; }
            });
        } else {
            switch($ctrl.attr("type")) {
                case "text" :   case "hidden":  case "textarea":
                    $ctrl.val(value);
                    break;
                case "radio":
                    if(value) {
                        $ctrl.filter('[value="'+value+'"]').click();
                    } else {
                        $ctrl.each(function(){
                            $(this).prop('checked', false);
                        });
                        $ctrl.closest('.talent-checkable').removeClass('selected');
                    }

                    break;
                case "checkbox":
                    if(Array.isArray(value)) {
                        value.forEach(function(v){
                            $ctrl.filter('[value="'+v+'"]').click();
                        });
                    } else {
                        $ctrl.filter('[value="'+value+'"]').click();
                    }

                    if(value == [] || value == "") {
                        $ctrl.each(function(){
                            $(this).prop('checked', false);
                        });
                        $ctrl.closest('.talent-checkable').removeClass('selected');
                    }
                    break;
                break;
            }
        }
    });
};


module.exports = FormFiller;
