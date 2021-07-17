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

//Supplier
let storeSupplier = require('./components/supplier/create.vue').default;
let allSuppliers = require('./components/supplier/index.vue').default;
let editSupplier = require('./components/supplier/edit.vue').default;

let storeCategory = require('./components/category/create.vue').default;
let allCategory = require('./components/category/index.vue').default;
let editCategory = require('./components/category/edit.vue').default;

let storeProduct = require('./components/product/create.vue').default;
let allProduct = require('./components/product/index.vue').default;
let editProduct = require('./components/product/edit.vue').default;


export const routes = [
    {path: '/', component: LoginPage, name: '/'},
    {path: '/register', component: RegisterPage, name: 'register'},
    {path: '/forget', component: ForgetPage, name: 'forget'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/homepage', component: Homepage, name: 'Homepage'},


    {path: '/addStaff', component: addStaff, name: 'addStaff'},
    {path: '/allStaff', component: allStaff, name: 'allStaff'},
    {path: '/edit-staff/:id', component: editStaff, name: 'editStaff'},

    {path: '/supplier', component: storeSupplier, name: 'createSupplier'},
    {path: '/suppliers', component: allSuppliers, name: 'allSuppliers'},
    {path: '/supplier/:id', component: editSupplier, name: 'editSupplier'},

    {path: '/category', component: storeCategory, name: 'storeCategory'},
    {path: '/allCategory', component: allCategory, name: 'allCategory'},
    {path: '/category/:id', component: editCategory, name: 'editCategory'},

    {path: '/', component: storeProduct, name: 'storeProduct'},
    {path: '/allProduct', component: allProduct, name: 'allProduct'},
    {path: '/product/:id', component: editProduct, name: 'editProduct'},

]
