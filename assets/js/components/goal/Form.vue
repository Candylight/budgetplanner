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
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.cost) }">
      <label for="_cost" class="control-label">cost</label>
      <input v-model.number="item.cost" type="number"  step="0.1" placeholder=""  id="_cost" class="form-control"  />
      <span v-if="errors && errors.cost" class="help-block" id="_cost_helpBlock">{{ errors.cost }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.limitDate) }">
      <label for="_limitDate" class="control-label">limitDate</label>
      <datepicker v-model="item.limitDate"  placeholder=""  id="_limitDate" class="form-control" />
      <span v-if="errors && errors.limitDate" class="help-block" id="_limitDate_helpBlock">{{ errors.limitDate }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.isCompleted) }">
      <label for="_isCompleted" class="control-label">isCompleted</label>
      <input v-model="item.isCompleted" type="checkbox"  placeholder=""  id="_isCompleted" class="form-control" />
      <span v-if="errors && errors.isCompleted" class="help-block" id="_isCompleted_helpBlock">{{ errors.isCompleted }}</span>
    </div>
    <div :class="{ 'form-group': true, 'has-error': (errors && errors.percentageDone) }">
      <label for="_percentageDone" class="control-label">percentageDone</label>
      <input v-model.number="item.percentageDone" type="number"  placeholder=""  id="_percentageDone" class="form-control" />
      <span v-if="errors && errors.percentageDone" class="help-block" id="_percentageDone_helpBlock">{{ errors.percentageDone }}</span>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';

  export default {
    components: {
      Datepicker
    },
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
