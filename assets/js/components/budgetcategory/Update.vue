<template>
  <div>
    <h1>Edit {{ item && item['@id'] }}</h1>

    <div v-if="created" class="alert alert-success" role="status">{{ created['@id'] }} created.</div>
    <div v-if="updated" class="alert alert-success" role="status">{{ updated['@id'] }} updated.</div>
    <div v-if="retrieveLoading || updateLoading || deleteLoading"class="alert alert-info" role="status">Loading...</div>
    <div v-if="retrieveError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ retrieveError }}</div>
    <div v-if="updateError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ updateError }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <BudgetCategoryForm v-if="item" :handle-submit="update" :values="item" :errors="violations" :initialValues="retrieved"></BudgetCategoryForm>
    <router-link v-if="item" :to="{ name: 'BudgetCategoryList' }" class="btn btn-default">Back to list</router-link>
    <button @click="del" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import BudgetCategoryForm from './Form.vue';
  import { mapGetters } from 'vuex';

  export default {
    created () {
      this.$store.dispatch('budgetcategory/update/retrieve', decodeURIComponent(this.$route.params.id));
    },
    components: {
      BudgetCategoryForm
    },
    computed: {
      ...mapGetters({
        retrieveError: 'budgetcategory/update/retrieveError',
        retrieveLoading: 'budgetcategory/update/retrieveLoading',
        updateError: 'budgetcategory/update/updateError',
        updateLoading: 'budgetcategory/update/updateLoading',
        deleteError: 'budgetcategory/del/error',
        deleteLoading: 'budgetcategory/del/loading',
        created: 'budgetcategory/create/created',
        deleted: 'budgetcategory/del/deleted',
        retrieved: 'budgetcategory/update/retrieved',
        updated: 'budgetcategory/update/updated',
        violations: 'budgetcategory/update/violations'
      })
    },
    data: function() {
      return {
        item: {}
      }
    },
    methods: {
      update (values) {
        this.$store.dispatch('budgetcategory/update/update', {item: this.retrieved, values: values });
      },
      del () {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('budgetcategory/del/delete', this.retrieved);
      },
      reset () {
        this.$store.dispatch('budgetcategory/update/reset');
        this.$store.dispatch('budgetcategory/del/reset');
        this.$store.dispatch('budgetcategory/create/reset');

      }
    },
    watch: {
      deleted: function (deleted) {
        if (deleted) {
          this.$router.push({ name: 'BudgetCategoryList' });
        }
      }
    },
    beforeDestroy() {
      this.reset();
    }
  }
</script>
