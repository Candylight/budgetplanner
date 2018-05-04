import BudgetCategoryList from '../components/budgetcategory/List.vue';
import BudgetCategoryCreate from '../components/budgetcategory/Create.vue';
import BudgetCategoryUpdate from '../components/budgetcategory/Update.vue';
import BudgetCategoryShow from '../components/budgetcategory/Show.vue';

export default [
  { name: 'BudgetCategoryList', path: '/budget_categories/', component: BudgetCategoryList },
  { name: 'BudgetCategoryCreate', path: '/budget_categories/create', component: BudgetCategoryCreate },
  { name: 'BudgetCategoryUpdate', path: "/budget_categories/edit/:id", component: BudgetCategoryUpdate },
  { name: 'BudgetCategoryShow', path: "/budget_categories/show/:id", component: BudgetCategoryShow  }
];
