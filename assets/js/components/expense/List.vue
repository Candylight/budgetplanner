<template>
  <div>
    <h1>Expense List</h1>

    <div v-if="loading" class="alert alert-info">Loading...</div>
    <div v-if="deletedItem" class="alert alert-success">{{ deletedItem['@id'] }} deleted.</div>
    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <span v-if="view">
      <button
        type="button"
        class="btn btn-basic btn-sm"
        @click="getPage(view['hydra:first'])"
        :disabled="!view['hydra:previous']"
      >First</button>
      &nbsp;
      <button
        type="button"
        class="btn btn-basic btn-sm"
        @click="getPage(view['hydra:previous'])"
        :disabled="!view['hydra:previous']"
      >Previous</button>
      &nbsp;
      <button
        type="button" class="btn btn-basic btn-sm"
        @click="getPage(view['hydra:next'])"
        :disabled="!view['hydra:next']"
      >Next</button>
      &nbsp;
      <button
        type="button" class="btn btn-basic btn-sm"
        @click="getPage(view['hydra:last'])"
        :disabled="view['hydra:last']"
      >Last</button>
      &nbsp;
    </span>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>name</th>
            <th>description</th>
            <th>amount</th>
            <th>category</th>
            <th>isRecurrent</th>
            <th>date</th>
            <th>recurringDate</th>
            <th>priority</th>
            <th>budgets</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items">
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['@id'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['name'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['description'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['amount'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['category'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['isRecurrent'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['date'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['recurringDate'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['priority'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">{{ item['budgets'] }}</router-link></td>
            <td>
              <router-link :to="{name: 'ExpenseShow', params: { id: item['@id'] }}">
                <span class="glyphicon glyphicon-search" aria-hidden="true"/>
                <span class="sr-only">Show</span>
              </router-link>
            </td>
            <td>
              <router-link :to="{name: 'ExpenseUpdate', params: { id: item['@id'] }}">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                <span class="sr-only">Edit</span>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link :to="{ name: 'ExpenseCreate' }" class="btn btn-default">Create</router-link>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex';

  export default {
    computed: mapGetters({
      deletedItem: 'expense/del/deleted',
      error: 'expense/list/error',
      items: 'expense/list/items',
      loading: 'expense/list/loading',
      view: 'expense/list/view'
    }),
    methods: mapActions({
      getPage: 'expense/list/getItems'
    }),
    created () {
      this.$store.dispatch('expense/list/getItems')
    }
  }
</script>
