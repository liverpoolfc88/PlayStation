import Vue from 'vue'
import VueRouter from 'vue-router'
import Layout from '@/views/layouts/Layout'
import Home from '@/views/Home'
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: Layout,
    hidden: true,
    children: [
      {
        path: '/',
        component: Home
      }
    ]
  },
  {
    path: '/home',
    component: Layout,
    children: [
      {
        path: '/home',
        component: () =>
          import('@/views/Home')
      }
    ]
  },
  {
    path: '/room',
    component: Layout,
    children: [
      {
        path: '/room',
        component: () =>
          import('@/views/Room')
      }
    ]
  },
  {
    path: '/',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Home.vue')
  }
]

const router = new VueRouter({
  // mode: 'hash',
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
