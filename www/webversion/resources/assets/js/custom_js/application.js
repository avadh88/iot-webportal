"use strict";

$(document).ready(function () {

    $("#app_company_id").select2({
        theme: "bootstrap",
        placeholder: "Select Company"
    });

    $("#app_company_id").on("change", function () {
        var id = $(this).val();

        axios.post('http://192.168.1.69:81/eblapihub/api/permanent/devicelist', {
            id: id
        })
            .then(function (response) {
                data = response.data.data;
                console.log(data);
                count = response.data.data.length;
                $('#device_name').empty();
                $('#device_name').append('<option value="Please select Device ">Please select Device </option>');

                for (let i = 0; i < count; i++) {
                    $('#device_name').append('<option value="' + data[i].id + '">' + data[i].device_name + '</option>');
                }
            })
            .catch(function (response) {
                console.log(response);
            });
    });

    $("#device_name").select2({
        theme: "bootstrap",
        placeholder: "Please select Device"
    });

    // $("#app_load").prop('disabled', true);;

});

function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $("#previewImg").attr("src", reader.result).width('64px')
                .height('64px');;
        }

        reader.readAsDataURL(file);
    }
}