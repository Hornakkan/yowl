import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/apidoc',
      name: 'apidoc',
      component: () => import('../views/ApidocView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
      // path: '/profile/:id',
      path: '/profile',
      name: 'profile',
      component: () => import('../views/ProfileView.vue')
    },
    {
      path: '/forgot',
      name: 'forgot',
      component: () => import('../views/ForgotView.vue')
    },
    {
      path: '/reset',
      name: 'reset',
      component: () => import('../views/ResetView.vue')
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/AdminView.vue')
    },
    {
      path: '/review/:id',
      name: 'review',
      component: () => import('../views/TheReviewView.vue'),
      props : true,
    },
    {
      path:'/NewReview',
      name:'NewReview',
      component:()=> import('../views/NewReview.vue'),
    },
    {
      path:'/games',
      name:'games',
      component:()=> import('../views/GameView.vue'),
    },
    {
      path:'/users',
      name:'users',
      component:()=> import('../views/UserView.vue'),
    }
  ]
})

export default router
