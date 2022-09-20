import { createRouter, createWebHistory } from 'vue-router'
import Clientes from "../views/Clientes";
import Produtos from "../views/Produtos";
import Pedidos from "@/views/Pedidos";

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
  },
  {
      path: '/pedidos',
      name: 'Pedidos',
      component: Pedidos
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
