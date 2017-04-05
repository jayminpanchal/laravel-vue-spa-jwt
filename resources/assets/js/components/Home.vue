<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body"></div>
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
                authenticate: {
                    email: '',
                    password: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            login(){
                let authenticate = {
                    email: this.authenticate.email,
                    password: this.authenticate.password
                };
                let component = this;
                axios.post('/api/login', authenticate)
                    .then(function (response) {
                        if (response.data.meta.status === "fail") {
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
