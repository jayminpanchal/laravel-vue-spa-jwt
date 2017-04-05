<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#" @submit.prevent="register">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus
                                       v-model="user.name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required
                                       v-model="user.email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       v-model="user.password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required v-model="user.confirm_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
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
        <div class="modal fade" id="reg-success" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content size">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message</h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4>{{message}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                apiStatus: '',
                message: '',
                user: {
                    name: '',
                    email: '',
                    password: '',
                    confirm_password: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            register(){
                let component = this;
                axios.post('/api/register', this.user)
                    .then(function (response) {
                        component.message = response.data.meta.message;
                        component.apiStatus = response.data.meta.status;
                        if (response.data.meta.status === "ok") {
                            component.user.email = '';
                            component.user.password = '';
                            component.user.name = '';
                            component.user.confirm_password = '';
                            $("#reg-success").modal('show');
                        }
                    }, function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>
