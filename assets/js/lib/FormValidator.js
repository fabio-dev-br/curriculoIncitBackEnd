function FormValidator() {

}

FormValidator.formErrors = {};

FormValidator.DEFAULT_ERROR_MESSAGE = 'Campo Obrigatório';

FormValidator.V_MATCH = 'validatorMatch';
FormValidator.V_MIN_LENGTH = 'validatorMinlength';
FormValidator.V_CPF = 'validatorCpf';
FormValidator.V_PHONE = 'validatorPhone';
FormValidator.V_ZIP = 'validatorZip';
FormValidator.V_NUMERIC = 'validatorNumeric';
FormValidator.V_AT_LEAST = 'validatorAtLeast';
FormValidator.V_AT_MOST = 'validatorAtMost';


FormValidator.checkCpf = function (str) {
    var sum = 0;
    var mod;
    var strCPF = str.replace(/\D/g, '');
    if (strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999"
    ) {
        return false;
    }

    for (var i = 1; i <= 9; i++) {
        sum += parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    }
    mod = (sum * 10) % 11;

    if (mod == 10 || mod == 11) {
        mod = 0;
    }
    if (mod != parseInt(strCPF.substring(9, 10))) {
        return false;
    }

    sum = 0;
    for (var i = 1; i <= 10; i++) {
        sum += parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    }
    mod = (sum * 10) % 11;

    if (mod == 10 || mod == 11) {
        mod = 0;
    }

    if (mod != parseInt(strCPF.substring(10, 11))) {
        return false;
    }
    return true;
}

FormValidator.checkPhone = function (str) {
    var strPhone = str.replace(/\D/g, '');
    return strPhone.length < 10 ? false : true;
}

FormValidator.checkZip = function (str) {
    var strZip = str.replace(/\D/g, '');
    return strZip.length != 8 ? false : true;
}

FormValidator.checkNumeric = function (str) {
    return !isNaN(str);
}

FormValidator.hasAtLeast = function($el, numberSelected) {
    var $formGroup = $el.closest('.form-group');

    if($el.attr('type') == 'checkbox') {
        var selecteds = $formGroup.find('input[name="'+$el.attr('name')+'"]').filter(':checked').length;
        // console.log('blalalal', selecteds, numberSelected);

        return selecteds >= numberSelected;
    }


    return false;
    //@Todo implementar para multiselect
}

FormValidator.hasAtMost = function($el, numberSelected) {
    var $formGroup = $el.closest('.form-group');

    if($el.attr('type') == 'checkbox') {
        var selecteds = $formGroup.find('input[name="'+$el.attr('name')+'"]').filter(':checked').length;
        // console.log('blalalal', selecteds, numberSelected);

        return selecteds <= numberSelected;
    }


    return false;
    //@Todo implementar para multiselect
}

FormValidator.getElementErrorMessage = function ($el) {

    if(!$el.length) {
        throw 'Nenhum elemento foi encontrado. Verifique se o campo está dentro de um `.form-group`';
    }

    if (!$el.prop('required') && $el.val() === "") {
        return false;
    }

    // validação nativa
    var isValid = $el[0].checkValidity();

    if (!isValid) {
        return $el.attr('data-validator-message') || FormValidator.DEFAULT_ERROR_MESSAGE;
    }


    // validação específica
    var elementValue = $el.val();
    var dataset = $el.data();
    var message = '', dontStop = true;
    // console.log('dataset', dataset);


    $.each(dataset, function (key, value) {
        // console.log('key value', key, value);
        switch (key) {
            case FormValidator.V_MATCH:
                var mtVal = $(value).val();
                dontStop = mtVal == elementValue;
                break;
            case FormValidator.V_MIN_LENGTH:
                dontStop = elementValue.length >= value;
                break;
            case FormValidator.V_CPF:
                dontStop = FormValidator.checkCpf(elementValue);
                break;
            case FormValidator.V_PHONE:
                dontStop = FormValidator.checkPhone(elementValue);
                break;
            case FormValidator.V_ZIP:
                dontStop = FormValidator.checkZip(elementValue);
                break;
            case FormValidator.V_NUMERIC:
                dontStop = FormValidator.checkNumeric(elementValue);
                break;
            case FormValidator.V_AT_LEAST:
                dontStop = FormValidator.hasAtLeast($el, value);
                break;
            case FormValidator.V_AT_MOST:
                dontStop = FormValidator.hasAtMost($el, value);
        }

        if (!dontStop) {
            message = dataset[key + 'Message'] || dataset['ValidatorMessage'] || FormValidator.DEFAULT_ERROR_MESSAGE;
            message = message.replace(/%.*%/, value);
        }

        return dontStop;
    });

    return message;
}

FormValidator.isValid = function ($form, showErrors) {
    var isValid = true;
    var fuid = $form.attr('data-validator-uid');
    // console.log('formErrors', FormValidator.formErrors, fuid);

    $form.find('input, textarea, select').each(function () {
        var $el = $(this);
        var elName = $el.attr('name');
        // console.log('name', elName);

        // console.log('el start', $el);

        // se um elemento de mesmo nome já possui erro vá para o próximo elemento.
        if(FormValidator.formErrors[fuid][elName]) {
            return true;
        }
        // console.log('name', elName);
        errorMessage = FormValidator.formErrors[fuid][elName] = FormValidator.getElementErrorMessage($el);

        if (showErrors) {
            FormValidator.placeError($el, errorMessage);
        }

        if(errorMessage) {
            isValid = false;
        }
    });

    return isValid;
};

FormValidator.enableOrDisableForm = function ($form, status) {
    $form.find("button[type='submit']").attr('disabled', status);
};

FormValidator.validate = function ($form, showErrors) {

    var isValid = FormValidator.isValid($form, showErrors);

    if (isValid) {
        FormValidator.enableOrDisableForm($form, false);
    } else {
        FormValidator.enableOrDisableForm($form, true);
    }

    return isValid;
}

FormValidator.validateElement = function ($el, showErrors) {

    $el = $el.closest('.form-group').find('[name="'+$el.attr('name')+'"]').first();
    var $form = $el.closest('form');
    var fuid = $form.attr('data-validator-uid');
    var name = $el.attr('name');
    var errorMessage = FormValidator.formErrors[fuid][name] = FormValidator.getElementErrorMessage($el);
    var isFormValid;

    // console.log('formErrors', FormValidator.formErrors, fuid);

    if (showErrors) {
        FormValidator.placeError($el, errorMessage);
    }

    // se o campo é válido, verifica se todos os outros campos já estão válidos para
    // habilitar o botão
    if (!errorMessage) {
        isFormValid = true;
        // console.log('testing...', FormValidator.formErrors[fuid]);
        $.each(FormValidator.formErrors[fuid], function (eln, elError) {
            if (elError) {
                FormValidator.enableOrDisableForm($form, true);
                return isFormValid = false;
            }
        });

        if(isFormValid) {
            FormValidator.enableOrDisableForm($form, false);
        }

    } else {
        FormValidator.enableOrDisableForm($form, true);
    }


    return !errorMessage;
}

FormValidator.placeError = function ($el, message) {

    var $formGroup = $el.closest('.form-group');

    if (message) {
        $formGroup
            .removeClass('has-success')
            .addClass('has-error')
            .find('.help-block')
            .text(message);
    } else {
        $formGroup
            .removeClass('has-error')
            .addClass('has-success')
            .find('.help-block').text('');
    }
}

FormValidator.setListeners = function ($form) {
    var fuid = $form.attr('data-validator-uid');
    $form.on("input change", "input, textarea, select", function () {
        FormValidator.validateElement($(this), true);
    });

    $form.on("ajaxForm:submitError", function (e, response) {

        if(!response || !response.data) {
            return;
        }

        // Server side field messages
        var keys = Object.keys(response.data);

        keys.forEach(function (name) {
            // console.log('keys name: ', name);
            var $el = $form.find("[name='" + name + "']");
            FormValidator.placeError($el, response.data[name]);
        });

        // server side global message
        if (response.message) {
            text = response.message;
        }

        PrettyAlerts.show({
            type: 'danger',
            dismissable: true,
            message: text
        });
    });

    $form.on('formValidator:revalidate', function(){
        var uid = $form.attr('data-validator-uid');
        FormValidator.formErrors[uid] = {};
        FormValidator.validate($form, false);
    });

    FormValidator.validate($form, false);
};

FormValidator.addForm = function (forms) {
    var $forms = $(forms);
    var uid;

    $forms.each(function () {
        var $f = $(this);
        uid = FormValidator.guid();
        $f.attr('data-validator-uid', uid);
        FormValidator.formErrors[uid] = {};
        FormValidator.setListeners($f);
    });
};


FormValidator.guid = function guid() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    return s4();
}

FormValidator.init = function (el) {
    FormValidator.addForm(el);
};

module.exports = FormValidator;
