<template>
  <div>
    <h1>New Income</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>

    <IncomeForm :handle-submit="create" :values="item" :errors="violations"></IncomeForm>
    <router-link :to="{ name: 'IncomeList' }" class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
  import IncomeForm from './Form.vue';
  import { createNamespacedHelpers } from 'vuex';

  const { mapActions, mapGetters } = createNamespacedHelpers('income/create');

  export default {
    components: {
      IncomeForm
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
        this.$store.dispatch('income/create/create', item);
      }
    },
    watch: {
      created: function (created) {
        if (created) {
          this.$router.push({ name: 'IncomeUpdate', params: { id: created['@id']} });
        }
      }
    }
  }
</script>
