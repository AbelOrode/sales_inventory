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
                                        <router-link to="/category" class="btn btn-primary"> Add Category</router-link>
                                    </div>
                                    <br>
                                    <br>
                                    <input type="text" class="form-control" style="width: 300px" placeholder="Search Supplier" v-model="searchTerm">
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                        <tr class="text-center">
                                                            <th>S/N</th>
                                                            <th>Category Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(category, index) in filtersearch" :key="category.id" class="text-center">
                                                            <td>{{ ++index }}</td>
                                                            <td> {{ category.category_name }} </td>
                                                            <td>
                                                                <router-link :to="{name: 'editCategory', params:{id:category.id}}" class="btn btn-sm btn-outline-primary">Edit</router-link> &nbsp;
                                                                <a @click="deleteCategory(category.id)" class="btn btn-sm btn-outline-warning text-dark">Delete</a>
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

<script>
    import axios from 'axios';
    export default {
        created(){
            if(!User.loggedIn()){
                this.$router.push({name : "/"})
            }
        },
        data(){
            return{
                categories:[],
                searchTerm: ''
            }
        },
        computed:{
            filtersearch(){
                return this.categories.filter(category =>{
                    return category.category_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allCategory(){
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
            },
            deleteCategory(id){
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
                        axios.delete('/api/category/'+id)
                            .then(() => {
                                this.categories = this.categories.filter(category => {
                                    return category.id != id;
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'allCategory'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Record deleted successfully',
                            'success'
                        )
                    }
                })
            }
        },
        created() {
            this.allCategory();
        }
    }
</script>

<style scoped>


</style>
