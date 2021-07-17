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
                                        <router-link to="/allCategory" class="btn btn-outline-secondary"> All Category
                                        </router-link>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Category</h1>
                                    </div>
                                    <form class="user" @submit.prevent="editCategory">

                                        <div class="form-row  mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter Category Name"
                                                           v-model="form.category_name" aria-labelledby="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="btn btn-outline-warning text-black-50 btn-block">Update
                                            </button>
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

        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                form: {
                    category_name: "",
                },
                errors: {}
            }
        },
        created() {
            let id = this.$route.params.id;
            axios.get('/api/category/'+id)
                .then(({data}) => (this.form = data))

        },
        methods:{
            editCategory() {
                let id = this.$route.params.id;
                axios.patch('/api/category/'+id, this.form)
                    .then(() => {
                        this.$router.push({name: 'allCategory'})
                        this.$noty.success("Record updated successfully")
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }

    }
</script>

<style scoped>

</style>
