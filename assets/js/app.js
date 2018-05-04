import Vue from 'vue'
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import App from './App.vue';

import goal from './store/modules/goal/';
import budget from './store/modules/budget/';
import budgetcategory from './store/modules/budgetcategory';
import expense from './store/modules/expense';
import income from './store/modules/income';

import goalRoutes from './routes/goal';
import budgetRoutes from './routes/budget';
import budgetcategoryRoutes from './routes/budgetcategory';
import expenseRoutes from './routes/expense';
import incomeRoutes from './routes/income';

Vue.use(Vuex);
Vue.use(VueRouter);

const store = new Vuex.Store({
  modules: {
    goal,
    budget,
    budgetcategory,
    expense,
    income
  }
});

const router = new VueRouter({
  mode: 'history',
  routes: [
    ...goalRoutes,
    ...budgetRoutes,
    ...budgetcategoryRoutes,
    ...expenseRoutes,
    ...incomeRoutes
  ]
});

new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});