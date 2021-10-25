require('./bootstrap');

window.Vue = require('vue');

Vue.component('device_status',require('/device_status.vue'));

const app = new Vue({
    el: "#device_status"
});