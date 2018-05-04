<template>
  <div>
    <h1>Show {{ item && item['@id'] }}</h1>

    <div v-if="loading" class="alert alert-info" role="status">Loading...</div>
    <div v-if="error" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ error }}</div>
    <div v-if="deleteError" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{ deleteError }}</div>

    <div v-if="item" class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>name</td>
            <td>{{ item['name'] }}</td>
          </tr>
          <tr>
            <td>description</td>
            <td>{{ item['description'] }}</td>
          </tr>
          <tr>
            <td>amount</td>
            <td>{{ item['amount'] }}</td>
          </tr>
          <tr>
            <td>category</td>
            <td>{{ item['category'] }}</td>
          </tr>
          <tr>
            <td>isRecurrent</td>
            <td>{{ item['isRecurrent'] }}</td>
          </tr>
          <tr>
            <td>date</td>
            <td>{{ item['date'] }}</td>
          </tr>
          <tr>
            <td>recurringDate</td>
            <td>{{ item['recurringDate'] }}</td>
          </tr>
          <tr>
            <td>priority</td>
            <td>{{ item['priority'] }}</td>
          </tr>
          <tr>
            <td>budgets</td>
            <td>{{ item['budgets'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link v-if="item" :to="{ name: 'ExpenseList' }" class="btn btn-default">Back to list</router-link>
    <button @click="deleteItem(item)" class="btn btn-danger">Delete</button>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';

  export default {
    computed: mapGetters({
      deleteError: 'expense/del/error',
      error: 'expense/show/error',
      loading: 'expense/show/loading',
      item: 'expense/show/item',
    }),
    methods: {
      deleteItem (item) {
        if (window.confirm('Are you sure you want to delete this item?'))
          this.$store.dispatch('expense/del/delete', item).then(response => this.$router.push({ name: 'ExpenseList' }));
      }
    },
    created () {
      this.$store.dispatch('expense/show/retrieve', decodeURIComponent(this.$route.params.id));
    },
    beforeDestroy() {
      this.$store.dispatch('expense/show/reset');
    }
  }
</script>
