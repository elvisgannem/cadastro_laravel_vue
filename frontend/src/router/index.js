import { createRouter, createWebHistory } from 'vue-router'
import Clientes from "../views/Clientes";
import Produtos from "../views/Produtos";

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Clientes
  },
  {
      path: '/produtos',
      name: 'Produtos',
      component: Produtos
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
