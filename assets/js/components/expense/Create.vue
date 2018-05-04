<template>
  <div>
    <h1>New Expense</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>

    <ExpenseForm :handle-submit="create" :values="item" :errors="violations"></ExpenseForm>
    <router-link :to="{ name: 'ExpenseList' }" class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
  import ExpenseForm from './Form.vue';
  import { createNamespacedHelpers } from 'vuex';

  const { mapActions, mapGetters } = createNamespacedHelpers('expense/create');

  export default {
    components: {
      ExpenseForm
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
        this.$store.dispatch('expense/create/create', item);
      }
    },
    watch: {
      created: function (created) {
        if (created) {
          this.$router.push({ name: 'ExpenseUpdate', params: { id: created['@id']} });
        }
      }
    }
  }
</script>
