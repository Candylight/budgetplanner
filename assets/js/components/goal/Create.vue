<template>
  <div>
    <h1>New Goal</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>

    <GoalForm :handle-submit="create" :values="item" :errors="violations"></GoalForm>
    <router-link :to="{ name: 'GoalList' }" class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
  import GoalForm from './Form.vue';
  import { createNamespacedHelpers } from 'vuex';

  const { mapActions, mapGetters } = createNamespacedHelpers('goal/create');

  export default {
    components: {
      GoalForm
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
        this.$store.dispatch('goal/create/create', item);
      }
    },
    watch: {
      created: function (created) {
        if (created) {
          this.$router.push({ name: 'GoalUpdate', params: { id: created['@id']} });
        }
      }
    }
  }
</script>
