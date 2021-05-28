/** Importing statements  **/

import VueRouter from 'vue-router';
import {routes} from './routes';
import Vue from 'vue';
import User from './Helper/User';


/** Use Statements **/
Vue.use(VueRouter);


Window.User = User;
const router = new VueRouter({
    routes,
    mode: 'history'
})


const app = new Vue({
    el: '#app',
    router
});
