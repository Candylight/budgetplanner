<template>
  <div>
    <h1>Edit {{ item && item['@id'] }}</h1>

    <div v-if="created" class="alert alert-success" role="status">{{ created['@id'] }} created.</div>
    <div v-if="updated" class="alert alert-success" role="status">{{ updated['@id'] }} updated.</div>
    <div v-if="retrieveLoading || updateLoading || deleteLoading"class="alert alert-info" role="status">Loading...</div>
    <div v-if="retrieveError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ retrieveError }}</div>
    <div v-if="updateError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ updateError }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <BudgetForm v-if="item" :handle-submit="update" :values="item" :errors="violations" :initialValues="retrieved"></BudgetForm>
    <router-link v-if="item" :to="{ name: 'BudgetList' }" class="btn btn-default">Back to list</router-link>
    <button @click="del" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import BudgetForm from './Form.vue';
  import { mapGetters } from 'vuex';

  export default {
    created () {
      this.$store.dispatch('budget/update/retrieve', decodeURIComponent(this.$route.params.id));
    },
    components: {
      BudgetForm
    },
    computed: {
      ...mapGetters({
        retrieveError: 'budget/update/retrieveError',
        retrieveLoading: 'budget/update/retrieveLoading',
        updateError: 'budget/update/updateError',
        updateLoading: 'budget/update/updateLoading',
        deleteError: 'budget/del/error',
        deleteLoading: 'budget/del/loading',
        created: 'budget/create/created',
        deleted: 'budget/del/deleted',
        retrieved: 'budget/update/retrieved',
        updated: 'budget/update/updated',
        violations: 'budget/update/violations'
      })
    },
    data: function() {
      return {
        item: {},
        categories: {},
      }
    },
    methods: {
      update (values) {
        this.$store.dispatch('budget/update/update', {item: this.retrieved, values: values });
      },
      del () {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('budget/del/delete', this.retrieved);
      },
      reset () {
        this.$store.dispatch('budget/update/reset');
        this.$store.dispatch('budget/del/reset');
        this.$store.dispatch('budget/create/reset');

      }
    },
    watch: {
      deleted: function (deleted) {
        if (deleted) {
          this.$router.push({ name: 'BudgetList' });
        }
      }
    },
    beforeDestroy() {
      this.reset();
    }
  }
</script>
