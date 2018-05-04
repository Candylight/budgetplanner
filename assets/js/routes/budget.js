import BudgetList from '../components/budget/List.vue';
import BudgetCreate from '../components/budget/Create.vue';
import BudgetUpdate from '../components/budget/Update.vue';
import BudgetShow from '../components/budget/Show.vue';

export default [
  { name: 'BudgetList', path: '/budgets/', component: BudgetList },
  { name: 'BudgetCreate', path: '/budgets/create', component: BudgetCreate },
  { name: 'BudgetUpdate', path: "/budgets/edit/:id", component: BudgetUpdate },
  { name: 'BudgetShow', path: "/budgets/show/:id", component: BudgetShow  }
];
