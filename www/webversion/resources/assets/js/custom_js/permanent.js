$(document).ready(function () {

    $("#edit_permanent").bootstrapValidator({
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


function deletePermanent(e) {
    if (!confirm('Do you want to delete?')) {
        e.preventDefault();
    }
}