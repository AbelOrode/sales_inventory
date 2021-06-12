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
                                        <router-link to="/allStaff" class="btn btn-outline-secondary"> All Staffs</router-link>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add New Employee</h1>
                                    </div>
                                    <form class="user" @submit.prevent="addStaff" enctype="multipart/form-data">

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Name" v-model ="form.name" aria-labelledby="name">
                                                </div>
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" aria-describedby="email"
                                                           placeholder="Enter Email Address" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" aria-describedby="contact"
                                                           placeholder="Phone Number" v-model="form.contact">
                                                    <small class="text-danger" v-if="errors.contact">{{ errors.contact[0]}}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" aria-describedby="salary"
                                                           placeholder="Monthly Salary" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]}}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" aria-describedby="address"
                                                       placeholder="Address" v-model="form.address">
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" aria-describedby="join_date"
                                                       placeholder="Date" v-model="form.join_date">
                                                <small class="text-danger" v-if="errors.join_date">{{ errors.join_date[0]}}</small>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" placeholder="Enter NID (Identification number)" v-model="form.nid">
                                                <small class="text-danger" v-if="errors.nid">{{ errors.nid[0]}}</small>
                                            </div>
                                        </div>

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <input type="file" class="custom-file-input" id="image" @change="onFileSelected">
                                                <label class="custom-file-label" for="image">Choose File</label>
                                                <small class="text-danger" v-if="errors.image">{{ errors.image[0]}}</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img :src="form.image" style="height: 40px; width: 40px">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-warning text-black-50 btn-block">Add</button>
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
                    contact: null,
                    salary:null,
                    address: null,
                    image: null,
                    nid: null,
                    join_date: null,
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
                        this.form.image = event.target.result
                        //console.log(event.target.result)
                    };
                    reader.readAsDataURL(file)
                }
            },
            addStaff(){
                axios.post('/api/staff', this.form)
                    .then(() =>{
                        this.$router.push({name: 'allStaff'})
                        this.$noty.success("Record created successfully")
                    })
                    .catch(error =>this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
