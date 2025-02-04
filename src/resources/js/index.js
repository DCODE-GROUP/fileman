import * as Vue from "vue";
window.Vue = Vue;


const app = window.Vue.createApp({});

import DirectoryList from "./components/DirectoryList.vue";

app.component("DirectoryList", DirectoryList);

app.mount("#fileman");
