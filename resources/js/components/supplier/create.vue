<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="d-inline">
                                        <router-link to="/allStaff" class="btn btn-outline-secondary"> Add Supplier</router-link>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Supplier</h1>
                                    </div>
                                    <form class="user" @submit.prevent="supplierInsert" enctype="multipart/form-data">

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Name" v-model ="form.name" aria-labelledby="name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" aria-describedby="email"
                                                           placeholder="Enter Email Address" v-model="form.email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" aria-describedby="contact"
                                                           placeholder="Phone Number" v-model="form.phone">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" aria-describedby="contact"
                                                           placeholder="Supplier" v-model="form.shopname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" aria-describedby="address"
                                                       placeholder="Address" v-model="form.address">
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
                                            </div>
                                        </div>

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <input type="file" class="custom-file-input" id="image" @change="onFileSelected">
                                                <label class="custom-file-label" for="image">Choose File</label>
                                                <small class="text-danger" v-if="errors.photo">{{ errors.image[0]}}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img :src="form.photo" style="height: 40px; width: 40px">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-warning text-black-50 btn-block">Create</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script type="text/javascript">
    import axios from 'axios'
    import User from '../../Helper/User.js';
    import Notification from '../../Helper/Notification.js';

    export default {
        name: "AddStaff",
        created() {
            if (!User.loggedIn()){
                this.$router.push({name : '/'})
            }

        },
        data(){
            return{
                form:{
                    name: null,
                    email: null,
                    phone: null,
                    shopname:null,
                    address: null,
                    photo: null,
                },
                errors:{}
            }
        },
        methods:{
            onFileSelected(event){
                let file = event.target.files[0]; // The event is an array collection that gives a description of uploaded file.
                if (file.size > 1048770){
                    this.$noty.error("The attachment size exceeds the allowable limit")
                }else {
                    let reader = new FileReader(); //
                    reader.onload = event =>{
                        this.form.photo = event.target.result
                        //console.log(event.target.result)
                    };
                    reader.readAsDataURL(file)
                }
            },
            supplierInsert(){
                axios.post('/api/supplier', this.form)
                    .then(() =>{
                        this.$router.push({name: 'allSuppliers'})
                    })
                    .catch(error =>this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
