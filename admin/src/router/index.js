import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home/Home.vue'
import Product from '../views/Product/Product.vue';
import ProductCreate from '../views/Product/Create.vue';
import Category from '../views/Category/Category.vue';
import Brand from '../views/Brand/Brand.vue'
import Sign from '../views/sign.vue'
import Account from '../views/Account/Account.vue';
import Option from '../views/Option/Option.vue';
import StockItem from '../views/Stock/stockItem.vue';
import Variant from '../views/Variant/Variant.vue';
import Warehouse from '../views/Warehouse/warehouse.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/categories',
    name: 'Category',
    component: Category
  },
  {
    path: '/brands',
    name: 'Brand',
    component: Brand
  },
  {
    path: '/products',
    name: 'Product',
    component: Product
  },
  {
    path: '/products-create',
    name: 'ProductCreate',
    component: ProductCreate
  },
  {
    path: '/accounts',
    name: 'Account',
    component: Account
  },
  {
    path: '/variants',
    name: 'Variant',
    component: Variant
  },
  {
    path: '/stock-item',
    name: 'StockItem',
    component: StockItem
  },
  {
    path: '/warehouse',
    name: 'Warehouse',
    component: Warehouse
  },
 
  {
    path: '/options',
    name: 'Option',
    component: Option
  },
  {
    path: '/sign',
    name: 'Sign',
    component: Sign
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
