jQuery(document).ready(function (){

    $("#selectAllUser").click(function () {
        $(".checkAllUser").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkAllUser").change(function(){
        if (!$(this).prop("checked")){
            $("#selectAllUser").prop("checked",false);
        }
    });

    $("#selectAllRole").click(function () {
        $(".checkAllRole").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkAllRole").change(function(){
        if (!$(this).prop("checked")){
            $("#selectAllRole").prop("checked",false);
        }
    });

    $("#selectAllTemp").click(function () {
        $(".checkAllTemp").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkAllTemp").change(function(){
        if (!$(this).prop("checked")){
            $("#selectAllTemp").prop("checked",false);
        }
    });

    $("#selectAllPermanent").click(function () {
        $(".checkAllpermanent").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkAllpermanent").change(function(){
        if (!$(this).prop("checked")){
            $("#selectAllPermanent").prop("checked",false);
        }
    });

    $("#selectAllCompany").click(function () {
        $(".checkAllcompany").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkAllcompany").change(function(){
        if (!$(this).prop("checked")){
            $("#selectAllCompany").prop("checked",false);
        }
    });


    $("#roleValidation").bootstrapValidator({
        fields: {
            role_name: {
                validators: {
                    notEmpty: {
                        message: 'The field is required'
                    }
                }
            },
        }
    });
    
});