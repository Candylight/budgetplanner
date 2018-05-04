<template>
  <div>
    <h1>Goal List</h1>

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
            <th>cost</th>
            <th>limitDate</th>
            <th>isCompleted</th>
            <th>percentageDone</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items">
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['@id'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['name'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['description'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['cost'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['limitDate'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['isCompleted'] }}</router-link></td>
            <td><router-link v-if="item" :to="{name: 'GoalShow', params: { id: item['@id'] }}">{{ item['percentageDone'] }}</router-link></td>
            <td>
              <router-link :to="{name: 'GoalShow', params: { id: item['@id'] }}">
                Show
              </router-link>
            </td>
            <td>
              <router-link :to="{name: 'GoalUpdate', params: { id: item['@id'] }}">
                Edit
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link :to="{ name: 'GoalCreate' }" class="btn btn-default">Create</router-link>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex';

  export default {
    computed: mapGetters({
      deletedItem: 'goal/del/deleted',
      error: 'goal/list/error',
      items: 'goal/list/items',
      loading: 'goal/list/loading',
      view: 'goal/list/view'
    }),
    methods: mapActions({
      getPage: 'goal/list/getItems'
    }),
    created () {
      this.$store.dispatch('goal/list/getItems')
    }
  }
</script>
