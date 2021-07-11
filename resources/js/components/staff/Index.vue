<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-sm-6">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="d-flex">
                                        <router-link to="/addStaff" class="btn btn-primary"> Add Employee</router-link>
                                    </div>
                                    <br>
                                    <br>
                                    <input type="text" class="form-control" style="width: 300px" placeholder="Search Employee" v-model="searchTerm">
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Number of Employee</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                        <tr class="text-center">
                                                            <th>S/N</th>
                                                            <th>Name</th>
                                                            <th>Image</th>
                                                            <th>Contact</th>
                                                            <th>Monthly Pay</th>
                                                            <th>Join Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(employee, index) in filtersearch" :key="employee.id" class="text-center">
                                                            <td>{{ ++index }}</td>
                                                            <td> {{ employee.name }} </td>
                                                            <td><img :src="employee.image" id="em_photo"></td>
                                                            <td>{{ employee.contact }}</td>
                                                            <td>{{ employee.salary}}</td>
                                                           <td>{{ employee.join_date }}</td>
                                                            <td>

                                                                <router-link :to="{name: 'editStaff', params:{id:employee.id}}" class="btn btn-sm btn-outline-primary">Edit</router-link> &nbsp;
                                                                <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-outline-warning text-dark">Delete</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

    </div>
</template>

<script type="text/javascript">
    import axios from 'axios';
    export default {
        created(){
            if(!User.loggedIn()){
                this.$router.push({name : "/"})
            }
        },
        data(){
            return{
                employees:[],
                searchTerm: ''
            }
        },
        computed:{
            filtersearch(){
                return this.employees.filter(employee =>{
                    return employee.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allEmployee(){
                axios.get('/api/staff/')
                    .then(({data}) => (this.employees = data))
            },
            deleteEmployee(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) =>{
                    if (result.value){
                        axios.delete('/api/staff/'+id)
                            .then(() => {
                                this.employees = this.employees.filter(employee => {
                                    return employee.id != id;
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'allStaff'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
        created() {
            this.allEmployee();
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
    }
</style>
