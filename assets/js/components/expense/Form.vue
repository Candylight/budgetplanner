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
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.amount) }">
      <label for="_amount" class="control-label">amount</label>
      <input v-model.number="item.amount" type="number"  step="0.1" placeholder=""  id="_amount" class="form-control" />
      <span v-if="errors && errors.amount" class="help-block" id="_amount_helpBlock">{{ errors.amount }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.category) }">
      <label for="_category" class="control-label">category</label>
      <input v-model="item.category" type="text"  placeholder=""  id="_category" class="form-control" />
      <span v-if="errors && errors.category" class="help-block" id="_category_helpBlock">{{ errors.category }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.isRecurrent) }">
      <label for="_isRecurrent" class="control-label">isRecurrent</label>
      <input v-model="item.isRecurrent" type="checkbox"  placeholder=""  id="_isRecurrent" class="form-control" />
      <span v-if="errors && errors.isRecurrent" class="help-block" id="_isRecurrent_helpBlock">{{ errors.isRecurrent }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.date) }">
      <label for="_date" class="control-label">date</label>
      <datepicker v-model="item.date" type="text"  placeholder=""  id="_date" class="form-control" />
      <span v-if="errors && errors.date" class="help-block" id="_date_helpBlock">{{ errors.date }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.recurringDate) }">
      <label for="_recurringDate" class="control-label">recurringDate</label>
      <input v-model="item.recurringDate" type="text"  placeholder=""  id="_recurringDate" class="form-control" />
      <span v-if="errors && errors.recurringDate" class="help-block" id="_recurringDate_helpBlock">{{ errors.recurringDate }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.priority) }">
      <label for="_priority" class="control-label">priority</label>
      <input v-model.number="item.priority" type="number"  placeholder=""  id="_priority" class="form-control" />
      <span v-if="errors && errors.priority" class="help-block" id="_priority_helpBlock">{{ errors.priority }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.budgets) }">
      <label for="_budgets" class="control-label">budgets</label>
      <input v-model="item.budgets" type="text"  placeholder=""  id="_budgets" class="form-control" />
      <span v-if="errors && errors.budgets" class="help-block" id="_budgets_helpBlock">{{ errors.budgets }}</span>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
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
      item: function () {
        return this.initialValues ? this.initialValues : this.values;
      }
    }
  }
</script>
