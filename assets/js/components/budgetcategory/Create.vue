<template>
  <div>
    <h1>New BudgetCategory</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>

    <BudgetCategoryForm :handle-submit="create" :values="item" :errors="violations"></BudgetCategoryForm>
    <router-link :to="{ name: 'BudgetCategoryList' }" class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
  import BudgetCategoryForm from './Form.vue';
  import { createNamespacedHelpers } from 'vuex';

  const { mapActions, mapGetters } = createNamespacedHelpers('budgetcategory/create');

  export default {
    components: {
      BudgetCategoryForm
    },
    data: function() {
      return {
        item: {}
      }
    },
    computed: mapGetters([
      'error',
      'loading',
      'created',
      'violations'
    ]),
    methods: {
      create: function(item) {
        this.$store.dispatch('budgetcategory/create/create', item);
      }
    },
    watch: {
      created: function (created) {
        if (created) {
          this.$router.push({ name: 'BudgetCategoryUpdate', params: { id: created['@id']} });
        }
      }
    }
  }
</script>
