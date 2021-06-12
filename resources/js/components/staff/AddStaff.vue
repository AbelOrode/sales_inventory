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
                                        <router-link to="/" class="btn btn-outline-secondary"> All Staffs</router-link>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add New Employee</h1>
                                    </div>
                                    <form class="user" @submit.prevent="register">

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
                                                    <input type="tel" class="form-control" aria-describedby="contact"
                                                           placeholder="Phone Number" v-model="form.contact">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" aria-describedby="salary"
                                                           placeholder="Monthly Salary" v-model="form.salary">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" aria-describedby="address"
                                                       placeholder="Address" v-model="form.address">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" aria-describedby="join_date"
                                                       placeholder="Date" v-model="form.join_date">
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" placeholder="Enter NID (Identification number)" v-model="form.nid">
                                            </div>
                                        </div>

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <input type="file" class="custom-file-input" id="image">
                                                <label class="custom-file-label" for="image">Choose File</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img src="form.image" style="height: 40px; width: 40px">
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

    import User from '.././../Helper/User.js'
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
                }
            }

        }
    }
</script>

<style scoped>

</style>
