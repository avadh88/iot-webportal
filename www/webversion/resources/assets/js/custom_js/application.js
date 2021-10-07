"use strict";

$(document).ready(function () {
    let emtApplicationId = document.getElementById('emtId').value;


    if (emtApplicationId) {
        document.getElementById('load').disabled = false;
    } else {
        document.getElementById('load').disabled = true;
    }

    
    // $("#app_company_id").select2({
    //     theme: "bootstrap",
    //     placeholder: "Select Company"
    // });

    document.getElementById('load').addEventListener('click', function (e) {
        if (!confirm('Are you sure to load image?')) {
            e.preventDefault();
        }
    })




    $("#device_name").select2({
        theme: "bootstrap",
        placeholder: "Please select Device"
    });

});

function deleteEmtApp(e) {
    if (!confirm('Do you want to delete?')) {
        e.preventDefault();
    }
}

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

var userId = document.getElementById('user_id').value;

// console.log(API_URL);

var vue = new Vue({
    el: ".fetchCompany",
    data: {
        companyList: [],
        deviceList: '',
        companyId: document.getElementById('app_company_id').value,
    },
    methods: {
        fetchEmtAppData: function () {
            axios.post('http://192.168.1.62:81/eblapihub/api/company/listbyid', {
                id: userId
            }).then(function (response) {
                vue.companyList = response.data.data;

            }).catch(function (response) {
                console.log(response);
            });
        },
        setDevice(event) {
            vue.deviceList = '';
            selectedCompany = event.target.value;

            for (i = 0; i < vue.companyList.length; i++) {

                if (selectedCompany == vue.companyList[i].company_id) {
                    vue.deviceList = vue.companyList[i].devicelist;
                }
            }
        },
        onLoad: function () {

        }
    },
    created: function () {
        setTimeout(function () {
            this.companyId = ($('#app_company_id').val());
            for (i = 0; i < vue.companyList.length; i++) {

                if (this.companyId == vue.companyList[i].company_id) {
                    vue.deviceList = vue.companyList[i].devicelist;
                }
            }
        }, 1500);
    },
    beforeMount: function () {
        this.fetchEmtAppData();
    },
    mounted: function () {
    },
    updated: function () {
    },
    afterMount: function () {
    }
})
