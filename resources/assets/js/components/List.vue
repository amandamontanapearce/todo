<template>
  <ul class="list-group mt-1">
    <li class="list-group-item opaqueBackground mt-1" v-for="(value, key, index) in displayList">
      <span :class="{ 'highPriority' : value.isHighPriority, 'completed' : value.isCompleted }">{{value.task}}</span>
      <span class="px-3" @click="completedTask(value)"><i class="fa fa-lg fa-check-square-o"></i></span>
      <span class="float-right" @click="removeTask(value.task)"><small>remove task</small></span>
    </li>
  </ul>
</template>

<script>
  export default {
    props: ['list'],
    computed: {
      displayList() {
          return _.orderBy(this.list, ['isCompleted', 'isHighPriority'], ['aced', 'desc']);
      },
    },
    methods: {
      completedTask(item) {
        item.isCompleted = true;
      },
      removeTask(task) {
        let taskIndex = this.list.indexOf( _.find( this.list, {'task': task}) );
        this.list.splice(taskIndex, 1);
      },
    }
  }
</script>
