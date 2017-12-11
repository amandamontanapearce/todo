<template>
  <div class="card card-body opaqueBackground mt-4 mb-5">
    <h2 id="addToTask"><i class="fa fa-plus"></i> Add to the list...</h2>
    <form>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <span class="input-group-addon text-info clickable" @click="addToDo()">ADD</span>
          <input v-model="task" class="form-control" type="text" placeholder="task" aria-label="task" aria-describedby="task">
        </div>
      </div>
      <div class="form-group">
        <div class="form-check form-check-inline radio-toggle">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" v-model="isHighPriority"> This task is high Priority.
          </label>
        </div>
      </div>
    </form>
  </div>
</template>

<style>
/*div.radio-toggle label input{
  display: none;
}*/

.radio-toggle {

}

.radio-toggle-selected {

}
</style>

<script>
  export default {
    props: ['list'],
    data() {
      return {
        isHighPriority: false,
        task: '',
      };
    },
    methods: {
      addToDo() {
        // basic validation, should be replaces with validation library
        if (this.task.length > 0) {
          this.list.push({
            'task': this.task,
            'isCompleted': false,
            'isHighPriority': this.isHighPriority,
          });
          this.task = '';
        }
      },
    },
  }
</script>
