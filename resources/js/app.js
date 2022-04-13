/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
import Vue from "vue";
import router from './routes/routes';
import AppManager from "./AppManager";

window.Vue = require("vue");

new Vue({
    el: "#app",
    router,
    template: '<AppManager/>',
    components: {
        AppManager,
    },
});
