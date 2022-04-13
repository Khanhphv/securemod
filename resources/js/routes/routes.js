import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "../components/LoginComponent";
import Register from "../components/Register";
Vue.use(VueRouter);

const router =  new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', component: LoginComponent },
        { path: '/register', component: Register },
    ],
})

export default router
