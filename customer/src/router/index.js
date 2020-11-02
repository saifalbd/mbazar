import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/home/Home2.vue';
import Checkout from '../views/checkout/Checkout.vue';
import Login from '../views/login/Login.vue'
import Categories from '../views/category/index.vue'
import Category from '../views/category/Category.vue';

import Product from '../views/product/Product.vue';



import {authGuestBeforeEnter} from './_internal/middleware'






Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    beforeEnter:authGuestBeforeEnter
  },
  {
    path: '/products/:slug',
    name: 'Product',
    component: Product,
    beforeEnter:authGuestBeforeEnter
  },
  {
    path: '/categories',
    name: 'Categories',
    component: Categories,
    beforeEnter:authGuestBeforeEnter
  },
  {
    path: '/categories/:slug',
    name: 'Category',
    component: Category,
    beforeEnter:authGuestBeforeEnter
  },
  {
    path: '/checkout',
    name: 'Checkout',
    component: Checkout,
    beforeEnter:authGuestBeforeEnter
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  // {
  //  // path: '/about',
    // name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
   // component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  // }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
