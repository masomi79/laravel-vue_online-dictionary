import Router from 'vue-router'

import Home from './components/home.vue'

const routes = [

  {
    path: '/miskito2/public/',
    name: 'home',
    component: Home
  }

]

export default new Router({
  mode: 'history',
  routes
});