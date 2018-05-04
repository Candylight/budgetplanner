<template>
  <div>
    <h1>Edit {{ item && item['@id'] }}</h1>

    <div v-if="created" class="alert alert-success" role="status">{{ created['@id'] }} created.</div>
    <div v-if="updated" class="alert alert-success" role="status">{{ updated['@id'] }} updated.</div>
    <div v-if="retrieveLoading || updateLoading || deleteLoading"class="alert alert-info" role="status">Loading...</div>
    <div v-if="retrieveError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ retrieveError }}</div>
    <div v-if="updateError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ updateError }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <ExpenseForm v-if="item" :handle-submit="update" :values="item" :errors="violations" :initialValues="retrieved"></ExpenseForm>
    <router-link v-if="item" :to="{ name: 'ExpenseList' }" class="btn btn-default">Back to list</router-link>
    <button @click="del" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import ExpenseForm from './Form.vue';
  import { mapGetters } from 'vuex';

  export default {
    created () {
      this.$store.dispatch('expense/update/retrieve', decodeURIComponent(this.$route.params.id));
    },
    components: {
      ExpenseForm
    },
    computed: {
      ...mapGetters({
        retrieveError: 'expense/update/retrieveError',
        retrieveLoading: 'expense/update/retrieveLoading',
        updateError: 'expense/update/updateError',
        updateLoading: 'expense/update/updateLoading',
        deleteError: 'expense/del/error',
        deleteLoading: 'expense/del/loading',
        created: 'expense/create/created',
        deleted: 'expense/del/deleted',
        retrieved: 'expense/update/retrieved',
        updated: 'expense/update/updated',
        violations: 'expense/update/violations'
      })
    },
    data: function() {
      return {
        item: {}
      }
    },
    methods: {
      update (values) {
        this.$store.dispatch('expense/update/update', {item: this.retrieved, values: values });
      },
      del () {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('expense/del/delete', this.retrieved);
      },
      reset () {
        this.$store.dispatch('expense/update/reset');
        this.$store.dispatch('expense/del/reset');
        this.$store.dispatch('expense/create/reset');

      }
    },
    watch: {
      deleted: function (deleted) {
        if (deleted) {
          this.$router.push({ name: 'ExpenseList' });
        }
      }
    },
    beforeDestroy() {
      this.reset();
    }
  }
</script>
