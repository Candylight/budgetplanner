import IncomeList from '../components/income/List.vue';
import IncomeCreate from '../components/income/Create.vue';
import IncomeUpdate from '../components/income/Update.vue';
import IncomeShow from '../components/income/Show.vue';

export default [
  { name: 'IncomeList', path: '/incomes/', component: IncomeList },
  { name: 'IncomeCreate', path: '/incomes/create', component: IncomeCreate },
  { name: 'IncomeUpdate', path: "/incomes/edit/:id", component: IncomeUpdate },
  { name: 'IncomeShow', path: "/incomes/show/:id", component: IncomeShow  }
];
