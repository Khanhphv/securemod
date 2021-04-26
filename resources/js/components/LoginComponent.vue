<template>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo text-center">
                                <a href="/"><img src="/images/logo.png" alt="logo"></a>
                            </div>
                            <!--                            <h4>Login to SecureCheats</h4>-->
                            <form class="pt-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border-left-0"
                                               id="email" placeholder="Email" v-model="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0"
                                               id="password" v-model="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="button" v-on:click="NormalLogin"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        LOGIN
                                    </button>
									
                                </div>
								<div class="my-3">
                                    <a class="btn btn-block btn-default btn-lg font-weight-medium auth-form-btn" href="https://securecheat.xyz/register">REGISTER</a>
                                </div>
								
                                <p class="text-center">OR</p>
                                <div class="mb-2 d-block">
                                    <button type="button" class="btn btn-facebook auth-form-btn flex-grow col-12 mb-2"
                                            v-on:click="LoginWithFB">
                                        <i class="mdi mdi-facebook mr-2"></i>Login via Facebook
                                    </button>
                                    <button type="button" class="btn btn-google auth-form-btn flex-grow col-12 mb-2"
                                            v-on:click="LoginWithGoogle">
                                        <i class="mdi mdi-google mr-2"></i>Login via Google
                                    </button>
<!--                                    <button type="button" class="btn btn-discord auth-form-btn flex-grow col-12 mb-2"-->
<!--                                            v-on:click="LoginWithDiscord">-->
<!--                                        <i class="mdi mdi-discord mr-2"></i>Login via Discord-->
<!--                                    </button>-->
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    If you do not have an account, the system will automatically create new for you<br>
									<a href="https://securecheat.xyz/blog/6">Terms of Service and Refund Policy.</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-none d-lg-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy;
                            2019
                            All rights reserved.</p>
							
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'

    export default {
        mounted() {
            console.log('Component loaded.');
        },
        components: {
            // Loading
        },
        props: ['logo_url', 'login_via_facebook', 'login_via_google', 'login_via_discord'],
        data: function () {
            return {
                email: null,
                password: null,
                isLoading: false,
                fullPage: true,
                color: "#4540f7"
            }
        },
        methods: {
            LoginWithFB: function () {
                window.location.href = this.login_via_facebook;
            },
            LoginWithDiscord: function () {
                window.location.href = this.login_via_discord;
            },
            LoginWithGoogle: function () {
                window.location.href = this.login_via_google;
            },
            NormalLogin: function () {
                axios.post('/customer_login', {
                    email: this.email,
                    password: this.password,
                    remember: 'on'
                }, {responseType: 'json'}).then(function (response) {
                    window.location.href = '/';
                    return Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Login Successfully',
                    });
                }).catch(function (error) {
                    let response_error = error.response.data.errors.email[0];
                    return Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: response_error,
                    });
                });
            }
        }
    }
</script>
