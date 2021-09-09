"use strict";

$(document).ready(function () {

    $('#companyValidation').bootstrapValidator({
        fields: {
            company_name: {
                validators: {
                    notEmpty: {
                        message: 'The Company Name is required and cannot be empty'
                    }
                }
            },
            company_address: {
                validators: {
                    notEmpty: {
                        message: 'The Company Address is required and cannot be empty'
                    }
                }
            },
            company_email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: 'The input is not a valid email address'
                    }
                }
            },
            company_mobile: {
                validators: {
                    notEmpty: {
                        message: 'The number is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^\d{10}$/,
                        message: 'The phone number can only consist of 10 numbers'
                    }
                }
            },
        },
        submitHandler: function (validator, form, submitButton) {
            var fullName = [validator.getFieldElements('firstName').val(),
                validator.getFieldElements('lastName').val()
            ].join(' ');
            $('#helloModal')
                .find('.modal-title').html('Hello ' + fullName).end()
                .modal();
        }
    });
});

function deleteCompany(e){
    if(!confirm('Do you want to delete?')){
        e.preventDefault();
    }
}