import ExpenseList from '../components/expense/List.vue';
import ExpenseCreate from '../components/expense/Create.vue';
import ExpenseUpdate from '../components/expense/Update.vue';
import ExpenseShow from '../components/expense/Show.vue';

export default [
  { name: 'ExpenseList', path: '/expenses/', component: ExpenseList },
  { name: 'ExpenseCreate', path: '/expenses/create', component: ExpenseCreate },
  { name: 'ExpenseUpdate', path: "/expenses/edit/:id", component: ExpenseUpdate },
  { name: 'ExpenseShow', path: "/expenses/show/:id", component: ExpenseShow  }
];
