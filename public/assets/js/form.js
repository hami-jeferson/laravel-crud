$(document).ready(function() {

    customer.validation();

});

$.validator.addMethod("exactLength24", function(value, element) {
    return this.optional(element) || /^\d{24}$/.test(value);
}, "Input must be exactly 24 integer characters.");
var customer = {
    validation: function(){

        // Initialize
        $("#customer-form").validate({

            ignore: [], // ignore hidden fields
            errorClass: 'validation-error-label text-danger',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {

                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {

                        error.appendTo( element.parent().parent().parent().parent() );

                    }
                    else {

                        error.appendTo( element.parent().parent().parent().parent().parent() );

                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {

                    error.appendTo( element.parent().parent().parent() );

                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {

                    error.appendTo( element.parent() );

                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {

                    error.appendTo( element.parent().parent() );

                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group') || element.parent().hasClass('bootstrap-select')) {

                    error.appendTo( element.parent().parent().parent() );

                }

                else {

                    error.insertAfter(element);

                }
            },

            rules: {
                // firstname:{
                //     required:true
                // },
                // lastname:{
                //     required: true
                // },
                // email:{
                //     required: true,
                //     email: true
                // },
                // date_of_birth:{
                //     required: true
                // },
                // phone_number:{
                //     required: true
                // },
                // bank_account_number:{
                //     required: true,
                //     exactLength24: true
                // }
            },
            messages: {},

            submitHandler: function (form) {

                var formdata = $(form).serializeArray();
                var mode = $(form).attr('method');
                var url = $(form).attr('action');

                $.ajax({

                    url: url,
                    dataType : 'json',
                    //contentType: 'application/json',
                    type: mode,
                    data: formdata,
                    success: function(e){
                        $('.error-section').hide();
                        $('.success-section').html(e.message);
                        $('.success-section').show();
                    },
                    error: function(xhr, status, error) {
                        $('.success-section').hide();
                        $('.error-section').html('<ul></ul>');
                        var parse = JSON.parse(xhr.responseText);
                        jQuery.each(parse.errors, function(index, item) {
                            jQuery.each(item, function(i, v) {
                                $('.error-section').find('ul').append('<li>'+v+'</li>');
                            });
                        });
                        $('.error-section').show();
                    },
                    beforeSend: function(){},
                    complete: function(){}

                });

            }

        });

    }
};
