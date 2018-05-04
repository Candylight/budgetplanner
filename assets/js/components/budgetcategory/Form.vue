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
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.expenses) }">
      <label for="_expenses" class="control-label">expenses</label>
      <input v-model="item.expenses" type="text"  placeholder=""  id="_expenses" class="form-control" />
      <span v-if="errors && errors.expenses" class="help-block" id="_expenses_helpBlock">{{ errors.expenses }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.incomes) }">
      <label for="_incomes" class="control-label">incomes</label>
      <input v-model="item.incomes" type="text"  placeholder=""  id="_incomes" class="form-control" />
      <span v-if="errors && errors.incomes" class="help-block" id="_incomes_helpBlock">{{ errors.incomes }}</span>
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
