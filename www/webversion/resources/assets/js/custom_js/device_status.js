var status;
var socket = io('http://192.168.1.62:8080');
var id;
var msg;
var permanents;

var vue = new Vue({
    el: ".app",
    data: {
        permanents: document.getElementById('permanents').value,
        status: '',
        id: '',
        msg: '',
    },
    methods: {
        fetchStatusData: function () {
            axios.get('http://192.168.1.62:81/eblapihub/api/permanent/status-data')
                .then(function (response) {
                    vue.status = response.data.data;
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },
    created: function () {
        this.fetchStatusData();
        let permanent = JSON.parse(this.permanents);

        socket.on('connect', () => {

            socket.on('status', function (data) {

                vue.id = data.uid;
                vue.msg = data.msg;
                
                console.log(vue.msg, vue.id, permanent);
                for (let i = 0; i < permanent.length; i++) {
                    
                    if(permanent[i].id == vue.id){
                        document.getElementById(permanent[i].id).innerHTML = vue.msg;
                    }
                }
            });

        });
    },
    updated: function () {}
});