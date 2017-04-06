<template>
    <div class="content">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="#">
                        Vue Spa
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <template v-if="isLoggedIn">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{authUser.name}}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="javascript:void(0);" v-on:click="logout">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <router-link to="/">Login</router-link>
                            </li>
                            <li>
                                <router-link to="signup">Register</router-link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
    import * as MutationTypes from './store/auth/MutationTypes';

    export default {
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            },
            authToken() {
                return this.$store.getters.authToken;
            }
        },
        mounted() {
        },
        methods: {
            logout(event) {
                let component = this;
                component.$store.dispatch(MutationTypes.LOGOUT);
                component.$router.push('/');
            }
        }
    }
</script>
