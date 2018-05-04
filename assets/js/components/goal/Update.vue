<template>
  <div>
    <h1>Edit {{ item && item['@id'] }}</h1>

    <div v-if="created" class="alert alert-success" role="status">{{ created['@id'] }} created.</div>
    <div v-if="updated" class="alert alert-success" role="status">{{ updated['@id'] }} updated.</div>
    <div v-if="retrieveLoading || updateLoading || deleteLoading"class="alert alert-info" role="status">Loading...</div>
    <div v-if="retrieveError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ retrieveError }}</div>
    <div v-if="updateError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ updateError }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <GoalForm v-if="item" :handle-submit="update" :values="item" :errors="violations" :initialValues="retrieved"></GoalForm>
    <router-link v-if="item" :to="{ name: 'GoalList' }" class="btn btn-info">Back to list</router-link>
    <button @click="del" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import GoalForm from './Form.vue';
  import { mapGetters } from 'vuex';

  export default {
    created () {
      this.$store.dispatch('goal/update/retrieve', decodeURIComponent(this.$route.params.id));
    },
    components: {
      GoalForm
    },
    computed: {
      ...mapGetters({
        retrieveError: 'goal/update/retrieveError',
        retrieveLoading: 'goal/update/retrieveLoading',
        updateError: 'goal/update/updateError',
        updateLoading: 'goal/update/updateLoading',
        deleteError: 'goal/del/error',
        deleteLoading: 'goal/del/loading',
        created: 'goal/create/created',
        deleted: 'goal/del/deleted',
        retrieved: 'goal/update/retrieved',
        updated: 'goal/update/updated',
        violations: 'goal/update/violations'
      })
    },
    data: function() {
      return {
        item: {}
      }
    },
    methods: {
      update (values) {
        this.$store.dispatch('goal/update/update', {item: this.retrieved, values: values });
      },
      del () {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('goal/del/delete', this.retrieved);
      },
      reset () {
        this.$store.dispatch('goal/update/reset');
        this.$store.dispatch('goal/del/reset');
        this.$store.dispatch('goal/create/reset');

      }
    },
    watch: {
      deleted: function (deleted) {
        if (deleted) {
          this.$router.push({ name: 'GoalList' });
        }
      }
    },
    beforeDestroy() {
      this.reset();
    }
  }
</script>
