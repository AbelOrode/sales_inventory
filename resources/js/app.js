/** Importing statements  **/

import VueRouter from 'vue-router';
import {routes} from './routes';
import Vue from 'vue';
import User from './Helper/User';
import Notification from './Helper/Notification';
import Swal from 'sweetalert2';
import VueNoty from 'vuejs-noty'



/** Use Statements **/
Vue.use(VueRouter);
Vue.use(VueNoty)

window.User = User;

window.Notification = Notification;
window.Swal = Swal;
const router = new VueRouter({
    routes,
    mode: 'history'
});



const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer())
    }
})

window.Toast = Toast;

const app = new Vue({
    el: '#app',
    router
});
