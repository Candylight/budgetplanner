<template>
  <form @submit.prevent="handleSubmit(item)">
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.name) }">
      <label for="_name" class="control-label">name</label>
      <input v-model="item.name" type="text"  placeholder=""  id="_name" class="form-control" />
      <span v-if="errors && errors.name" class="help-block" id="_name_helpBlock">{{ errors.name }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.description) }">
      <label for="_description" class="control-label">description</label>
      <input v-model="item.description" type="text"  placeholder=""  id="_description" class="form-control" />
      <span v-if="errors && errors.description" class="help-block" id="_description_helpBlock">{{ errors.description }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.goal) }">
      <label for="_goal" class="control-label">goal</label>
      <select v-model="item.goal" id="_goal">
        <option v-for="goal in goalList" v-bind:value="[{ '@id': goal['@id'] }]">
          {{ goal.name }}
        </option>
      </select>
      <span v-if="errors && errors.goal" class="help-block" id="_goal_helpBlock">{{ errors.goal }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.expense) }">
      <label for="_expense" class="control-label">expense</label>
      <input v-model="item.expense" type="text"  placeholder=""  id="_expense" class="form-control" />
      <span v-if="errors && errors.expense" class="help-block" id="_expense_helpBlock">{{ errors.expense }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.income) }">
      <label for="_income" class="control-label">income</label>
      <input v-model="item.income" type="text"  placeholder=""  id="_income" class="form-control" />
      <span v-if="errors && errors.income" class="help-block" id="_income_helpBlock">{{ errors.income }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.category) }">
      <label for="_category" class="control-label">category</label>
      <select v-model="item.category" id="_category">
        <option v-for="category in categoryList" v-bind:value="[{ '@id': category['@id'] }]">
          {{ category.name }}
        </option>
      </select>
      <span v-if="errors && errors.category" class="help-block" id="_category_helpBlock">{{ errors.category }}</span>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
  import { mapGetters } from 'vuex';

  export default {
    props: {
      handleSubmit: {
        type: Function,
        required: true,
      },
      values: {
        type: Object,
        required: true
      },
      errors: {
        type: Object
      },
      initialValues: {
        type: Object
      }
    },
    computed: {
      ...mapGetters({
        categoryList: ('budgetcategory/list/items'),
        goalList: ('goal/list/items')
      }),
      item: function () {
        return this.initialValues ? this.initialValues : this.values;
      },
    },
  }
</script>
