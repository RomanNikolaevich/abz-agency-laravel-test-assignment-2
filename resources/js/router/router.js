import {createRouter, createWebHistory} from 'vue-router';
import UsersPage from '../views/pages/UsersPage.vue';
import UserDetailPage from '../views/pages/UserDetailPage.vue';

const routes = [
    {path: '/', redirect: '/users'},
    {path: '/users', component: UsersPage},
    {path: '/users/:id', component: UserDetailPage, props: true},
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
