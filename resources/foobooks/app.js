import { createApp } from "vue";
import App from "./App.vue";

import { createRouter, createWebHistory } from 'vue-router';

import Content from "./components/Content.vue";
import Search from "./components/Search.vue";
import AddBook from "./components/AddBook.vue";
import NotFound from "./components/NotFound.vue";
import "./assets/css/index.css";

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: "/", component: Content },
        { path: "/search", name: Search, component: Search },
        { path: "/addbook", name: AddBook, component: AddBook },
        { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
    ],
});
app.use(router);

app.mount("#app");
