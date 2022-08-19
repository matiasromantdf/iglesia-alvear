import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AdminView from '../views/AdminView.vue'
import AddPersonaView from '../views/AddPersonaView.vue'
import AddLiderView from '../views/AddLiderView.vue'
import LiderView from '../views/LiderView.vue'
import VerPersonaView from '../views/VerPersonaView.vue'
import ConsejeriasView from '../views/ConsejeriasView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/admin',
      name: 'admin',
      component: AdminView
    },
    {
      path: '/add-persona',
      name: 'add-persona',
      component: AddPersonaView
    },
    {
      path: '/add-lider',
      name: 'add-lider',
      component: AddLiderView
    },
    {
      path: '/lider/:id',
      name: 'lider',
      component: LiderView
    },
    {
      path: '/ver-persona/:id',
      name: 'ver-persona',
      component: VerPersonaView
    },
    {
      path: '/consejerias',
      name:'consejerias',
      component: ConsejeriasView
    }

   
  ]
})

export default router
