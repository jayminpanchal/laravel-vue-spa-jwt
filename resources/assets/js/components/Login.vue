<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#" @submit.prevent="login">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus
                                       v-model="authenticate.email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       v-model="authenticate.password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="#">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <p v-if="apiStatus == 'fail'" class="c-red m-b-0 font-15">
                                {{message}}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import MutationTypes from '../store/auth/MutationTypes';

    export default {
        data() {
            return {
                apiStatus: '',
                message: '',
                authenticate: {
                    email: '',
                    password: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            login() {
                let authenticate = {
                    email: this.authenticate.email,
                    password: this.authenticate.password
                };
                let component = this;
                axios.post('/api/login', authenticate)
                    .then(function (response) {
                        console.log(response);
                        if (response.data.meta.status === "ok") {
                            component.$router.push('home');
                        } else {
                            component.message = response.data.meta.message;
                            component.apiStatus = response.data.meta.status;
                        }
                    }, function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>
