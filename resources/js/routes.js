//import Homepage from "./components/Homepage";

let LoginPage = require('./components/auth/LoginPage.vue').default;
let RegisterPage = require('./components/auth/RegisterPage.vue').default;
let ForgetPage = require('./components/auth/ForgetPage.vue').default;
let Logout = require('./components/auth/Logout.vue').default;

let Homepage = require('./components/Homepage.vue').default;

export const routes = [
    {path: '/', component: LoginPage, name: '/'},
    {path: '/register', component: RegisterPage, name: 'register'},
    {path: '/forget', component: ForgetPage, name: 'forget'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/homepage', component: Homepage, name: 'Homepage'}
]
