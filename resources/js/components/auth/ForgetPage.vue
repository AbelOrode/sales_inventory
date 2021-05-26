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
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <a href="index.html" class="btn btn-primary btn-block">Send Instructions</a>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <router-link to="/" class="btn btn-outline-warning text-black-50 btn-block">Back</router-link>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                                    </div>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold small">Forget Password</router-link>
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

<script>
    export default {
        name: "ForgetPage"
    }
</script>

<style scoped>

</style>
