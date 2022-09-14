import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import BlogPage from './pages/BlogPage';
import NotFound from './pages/NotFound';
import SinglePost from './pages/SinglePost';

// regole di routing
const router = new VueRouter({
    mode: 'history',
    routes: [
        { 
            path: '/', 
            name: 'home' ,
            component: HomePage
        },
        { 
            path: '/about', 
            name: 'about', 
            component: AboutPage
        },
        { 
            path: '/blog', 
            name: 'blog', 
            component: BlogPage
        },
        { 
            path: '/blog/:slug', 
            name: 'single-post', 
            component: SinglePost
        },
        { 
            path: '/*', 
            name: 'not-found', 
            component: NotFound
        }
      ]
  });

export default router;