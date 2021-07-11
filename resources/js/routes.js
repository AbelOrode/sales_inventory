//Authenticated routes


let LoginPage = require('./components/auth/LoginPage.vue').default;
let RegisterPage = require('./components/auth/RegisterPage.vue').default;
let ForgetPage = require('./components/auth/ForgetPage.vue').default;
let Logout = require('./components/auth/Logout.vue').default;
//End

let Homepage = require('./components/Homepage.vue').default;


//Staff or Employee components
let addStaff = require('./components/staff/AddStaff.vue').default;
let allStaff = require('./components/staff/Index.vue').default;
let editStaff = require('./components/staff/editStaff.vue').default;


export const routes = [
    {path: '/', component: LoginPage, name: '/'},
    {path: '/register', component: RegisterPage, name: 'register'},
    {path: '/forget', component: ForgetPage, name: 'forget'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/homepage', component: Homepage, name: 'Homepage'},
    {path: '/addStaff', component: addStaff, name: 'addStaff'},
    {path: '/allStaff', component: allStaff, name: 'allStaff'},
    {path: '/edit-staff/:id', component: editStaff, name: 'editStaff'}

]
