<template>
  <div>
    <h1>Budget List</h1>

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
            <th>goal</th>
            <th>expense</th>
            <th>income</th>
            <th>category</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items">
            <td><router-link v-if="item" :to="{name: 'BudgetShow', params: { id: item['@id'] }}">{{ item['@id'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'BudgetShow', params: { id: item['@id'] }}">{{ item['name'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'BudgetShow', params: { id: item['@id'] }}">{{ item['description'] }}</router-link></td>
            <td>
              <li v-for="goal in item['goal']">
                <router-link v-if="item" :to="{name: 'GoalShow', params: { id: goal['@id'] }}">
                  {{goal.name}}
                </router-link>
              </li>
            </td>
            <td>            <td><router-link v-if="item" :to="{name: 'BudgetShow', params: { id: item['@id'] }}">{{ item['expense'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'BudgetShow', params: { id: item['@id'] }}">{{ item['income'] }}</router-link></td>
            <td>
                <li v-for="budget_category in item['category']">
                    <router-link v-if="item" :to="{name: 'BudgetCategoryShow', params: { id: budget_category['@id'] }}">
                      {{budget_category.name}}
                    </router-link>
                </li>
            </td>
            <td>
              <router-link :to="{name: 'BudgetShow', params: { id: item['@id'] }}">
                <span class="glyphicon glyphicon-search" aria-hidden="true"/>
                <span class="sr-only">Show</span>
              </router-link>
            </td>
            <td>
              <router-link :to="{name: 'BudgetUpdate', params: { id: item['@id'] }}">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                <span class="sr-only">Edit</span>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link :to="{ name: 'BudgetCreate' }" class="btn btn-default">Create</router-link>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex';

  export default {
    computed: mapGetters({
      deletedItem: 'budget/del/deleted',
      error: 'budget/list/error',
      items: 'budget/list/items',
      loading: 'budget/list/loading',
      view: 'budget/list/view'
    }),
    methods: mapActions({
      getPage: 'budget/list/getItems'
    }),
    created () {
      this.$store.dispatch('budget/list/getItems')
    }
  }
</script>
