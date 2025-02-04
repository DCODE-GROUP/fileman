import * as Vue from "vue";
window.Vue = Vue;


const app = window.Vue.createApp({});

import Test from "./components/Test.vue";

app.component("FilemanTest", Test);

app.mount("#fileman");
