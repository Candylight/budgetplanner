import GoalList from '../components/goal/List.vue';
import GoalCreate from '../components/goal/Create.vue';
import GoalUpdate from '../components/goal/Update.vue';
import GoalShow from '../components/goal/Show.vue';

export default [
  { name: 'GoalList', path: '/goals/', component: GoalList },
  { name: 'GoalCreate', path: '/goals/create', component: GoalCreate },
  { name: 'GoalUpdate', path: "/goals/edit/:id", component: GoalUpdate },
  { name: 'GoalShow', path: "/goals/show/:id", component: GoalShow  }
];
