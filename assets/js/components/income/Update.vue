<template>
  <div>
    <h1>Edit {{ item && item['@id'] }}</h1>

    <div v-if="created" class="alert alert-success" role="status">{{ created['@id'] }} created.</div>
    <div v-if="updated" class="alert alert-success" role="status">{{ updated['@id'] }} updated.</div>
    <div v-if="retrieveLoading || updateLoading || deleteLoading"class="alert alert-info" role="status">Loading...</div>
    <div v-if="retrieveError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ retrieveError }}</div>
    <div v-if="updateError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ updateError }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <IncomeForm v-if="item" :handle-submit="update" :values="item" :errors="violations" :initialValues="retrieved"></IncomeForm>
    <router-link v-if="item" :to="{ name: 'IncomeList' }" class="btn btn-default">Back to list</router-link>
    <button @click="del" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import IncomeForm from './Form.vue';
  import { mapGetters } from 'vuex';

  export default {
    created () {
      this.$store.dispatch('income/update/retrieve', decodeURIComponent(this.$route.params.id));
    },
    components: {
      IncomeForm
    },
    computed: {
      ...mapGetters({
        retrieveError: 'income/update/retrieveError',
        retrieveLoading: 'income/update/retrieveLoading',
        updateError: 'income/update/updateError',
        updateLoading: 'income/update/updateLoading',
        deleteError: 'income/del/error',
        deleteLoading: 'income/del/loading',
        created: 'income/create/created',
        deleted: 'income/del/deleted',
        retrieved: 'income/update/retrieved',
        updated: 'income/update/updated',
        violations: 'income/update/violations'
      })
    },
    data: function() {
      return {
        item: {}
      }
    },
    methods: {
      update (values) {
        this.$store.dispatch('income/update/update', {item: this.retrieved, values: values });
      },
      del () {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('income/del/delete', this.retrieved);
      },
      reset () {
        this.$store.dispatch('income/update/reset');
        this.$store.dispatch('income/del/reset');
        this.$store.dispatch('income/create/reset');

      }
    },
    watch: {
      deleted: function (deleted) {
        if (deleted) {
          this.$router.push({ name: 'IncomeList' });
        }
      }
    },
    beforeDestroy() {
      this.reset();
    }
  }
</script>
