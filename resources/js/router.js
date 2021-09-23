import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home.vue';
import Contact from './pages/Contact.vue';
import About from './pages/About.vue';
import Post from './pages/Post.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/contatti',
            name: 'contact',
            component: Contact,
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About,
        },
        {
            path: '/post/:slug',
            name: 'post',
            component: Post,
        },
    ],
});

export default router;