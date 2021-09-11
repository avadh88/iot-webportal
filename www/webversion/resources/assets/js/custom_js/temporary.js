
$(document).ready(function () {

    $("#company_id").select2({
        theme: "bootstrap",
        placeholder: "single select"
    });

});


function deleteTemporaryDevice(e){
    if(!confirm('Do you want to delete?')){
        e.preventDefault();
    }
}