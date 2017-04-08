import Vue from "vue";
import Router from "vue-router";
import Login from "../components/Login.vue";
import SignUp from "../components/SignUp.vue";
import Home from "../components/Home.vue";
import {store} from "../store";
import * as MutationTypes from '../store/auth/MutationTypes';

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login
        },
        {
            path: '/signup',
            name: 'signup',
            component: SignUp
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        }
    ]
});


router.beforeEach((to, from, next) => {
    if (store.getters.isLoggedIn) {
        console.log("logged in");
        store.dispatch(MutationTypes.FETCH_USER).then(() => next());
    } else {
        console.log("not logged in");
        next();
    }
})
export default router;