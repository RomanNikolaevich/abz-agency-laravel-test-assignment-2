import {createRouter, createWebHistory} from 'vue-router';
import UsersPage from '../views/pages/UsersPage.vue';
import UserDetailPage from '../views/pages/UserDetailPage.vue';
import TokenRefresher from "../views/components/TokenRefresher.vue";
import UserCreatePage from "../views/pages/UserCreatePage.vue";
import AboutPage from "../views/pages/AboutPage.vue";

const routes = [
    {path: '/', redirect: '/users'},
    {path: '/users', component: UsersPage},
    {path: '/users/create', component: UserCreatePage},
    {path: '/token', component: TokenRefresher},
    {path: '/users/:id', component: UserDetailPage, props: true},
    {path: '/about', component: AboutPage},
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
