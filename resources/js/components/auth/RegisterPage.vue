<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form class="user" @submit.prevent="register">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter Name" v-model ="form.name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address" v-model="form.email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" v-model="form.password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                   placeholder="Confirm Password" v-model="form.password_confirmation">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-warning text-black-50 btn-block">Register</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script  type="text/javascript">
    import axios from 'axios';
    import User from '.././../Helper/User.js';

    export default {
        name: 'RegisterPage',
        created() {
            if (User.loggedIn()){
                this.$router.push({name: 'Homepage'})
            }
        },

        data(){
            return{
                form:{
                    name: null,
                    email:null,
                    password: null,
                    password_confirmation: null
                },
                errors:{}
            }
        },
        methods:{
            register(){
                axios.post('/api/auth/register', this.form)
                    .then(res =>{
                        User.resAfterLogin(res)
                        Toast.fire({
                            icon: 'success',
                            title: 'Registration successful' + " " + "Welcome " + User.getUser()


                        })
                        this.$router.push({ name: 'Homepage'})
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
