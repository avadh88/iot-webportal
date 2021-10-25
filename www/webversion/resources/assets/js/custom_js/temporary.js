
$(document).ready(function () {

    $("#company_id").select2({
        theme: "bootstrap",
        placeholder: "Select Company"
    });

    // 

    $("#temporary_form").bootstrapValidator({
        fields: {
            device_name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }, regexp: {
                        regexp: /^[a-zA-Z0-9\_]+$/,
                        message: 'Only character and "_" are allowed.'
                    }
                },
                required: true,
                minlength: 4
            },
        }
    });



});


function deleteTemporaryDevice(e) {
    if (!confirm('Do you want to delete?')) {
        e.preventDefault();
    }
}