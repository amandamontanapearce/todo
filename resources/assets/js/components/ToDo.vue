<template>
<div class="container">
  <h1>To-Do List, get to it!

    <a href="#addToTask">
    <span class="float-right"><i class="fa fa-plus"></i></span>
    </a>
    </h1>
  <ul class="list-group" v-for="(value, key, index) item in list">
    <li class="list-group-item" v-if="!value.isCompleted">
      <span :class="{ 'highPriority' : value.isHighPriority }">{{value.task}}</span>
      <span @click="completedTask(value)"><i class="fa fa-check-square-o"></i></span>
      <span class="float-right" @click="removeTask(index)">remove task</span>
    </li>
  </ul>
  <ul class="list-group" v-for="item in list">
    <li class="list-group-item" v-if="item.isCompleted">
      <strike :class="{ 'highPriority' : item.isHighPriority }">{{item.task}}</strike>
    </li>
  </ul>
  <div class="card card-body">
    <h2 id="addToTask">Add to the list...</h2>
    <form class="mt-3">
      <div class="form-group">
        <div class="input-group input-group-lg">
          <span class="input-group-addon" @click="addToDo()">ADD</span>
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
</div>
</template>

<style>
.highPriority {
  color: red;
}
</style>

<script>
export default {
  data() {
    return {
      isHighPriority: false,
      task: '',
      list: [],
    }
  },
  methods: {
    addToDo() {
      this.list.push({
        'task': this.task,
        'isCompleted': false,
        'isHighPriority': this.isHighPriority,
      });
      this.task = '';
    },
    completedTask(item) {
      item.isCompleted = true;
    },
    removeTask(index) {
      this.list.splice(index, 1);
    },
  },
  mounted() {},
}
</script>
