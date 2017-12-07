<template>
  <div class="card card-body opaqueBackground mt-4 mb-5">
    <h2 id="addToTask">Add to the list...</h2>
    <form>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <span class="input-group-addon text-info" @click="addToDo()">ADD</span>
          <input v-model="task" class="form-control" type="text" placeholder="task" aria-label="task" aria-describedby="task">
        </div>
      </div>
      <div class="form-group">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" value="true" v-model="isHighPriority">high
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" value="false" v-model="isHighPriority">normal
          </label>
        </div>
      </div>
    </form>
  </div>
</template>

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
