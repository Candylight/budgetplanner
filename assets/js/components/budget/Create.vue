<template>
  <div>
    <h1>New Budget</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>

    <BudgetForm :handle-submit="create" :values="item" :errors="violations"></BudgetForm>
    <router-link :to="{ name: 'BudgetList' }" class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
  import BudgetForm from './Form.vue';
  import { createNamespacedHelpers } from 'vuex';

  const { mapActions, mapGetters } = createNamespacedHelpers('budget/create');

  export default {
    components: {
      BudgetForm
    },
    data: function() {
      return {
        item: {},
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
        this.$store.dispatch('budget/create/create', item);
      }
    },
    watch: {
      created: function (created) {
        if (created) {
          this.$router.push({ name: 'BudgetUpdate', params: { id: created['@id']} });
        }
      }
    }
  }
</script>
