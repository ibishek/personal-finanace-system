import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./route/router";
import App from "./App.vue";

const pinia = createPinia();

createApp(App).use(pinia).use(router).mount("#app");
