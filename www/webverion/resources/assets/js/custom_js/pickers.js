"use strict";

$(document).ready(function () {

//==============On Off Text==========
    $(".ontext,.offtext").on("keyup", function () {
        var onoff_text = $('#onofftext');
        onoff_text.bootstrapSwitch('onText', $('.ontext').val());
        if ($('.ontext').val() == "") {
            onoff_text.bootstrapSwitch('onText', "ON");
        }
        onoff_text.bootstrapSwitch('offText', $('.offtext').val());
        if ($('.offtext').val() == "") {
            onoff_text.bootstrapSwitch('offText', "OFF");
        }
    });
    setTimeout(function () {

        $(".multiselect-container .multiselect-item .input-group-addon i").removeClass('glyphicon glyphicon-search');
        $(".multiselect-container .multiselect-item .input-group-addon").addClass('fa fa-search');

        $(".multiselect-container .multiselect-item .input-group-btn i").removeClass('glyphicon glyphicon-remove-circle');
        $(".multiselect-container .multiselect-item .input-group-btn i").addClass('fa fa-times-circle-o');
        $(".btn-group .multiselect b").removeClass('caret');
        $(".btn-group .multiselect b").addClass('fa fa-caret-down');
    },500)
});