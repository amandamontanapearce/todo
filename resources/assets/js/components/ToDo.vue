<template>
    <div class="container">
      <form class="mt-3">
        <div class="form-group">
          <div class="input-group input-group-lg">
            <span class="input-group-addon" @click="addToDo()">ADD</span>
              <input
                v-model="task"
                class="form-control"
                type="text"
                placeholder="task"
                aria-label="task"
                aria-describedby="task"
                >
          </div>
        </div>
      </form>
      <ul class="list-group" v-for="item in list">
        <li class="list-group-item" v-if="!item.completed">
        {{item.task}}
        <span class="float-right" @click="completedTask(item)"><i class="fa fa-check-square-o"></i></span>
        </li>
      </ul>
      <ul class="list-group" v-for="item in list">
        <li class="list-group-item" v-if="item.completed">
        <strike>{{item.task}}</strike>
        </li>
      </ul>
    </div>
</template>

<script>
    export default {
        data() {
          return {
            task: '',
            list: [],
          }
        },
        methods: {
          addToDo() {
            this.list.push({
            'task': this.task,
            'completed': false,
            });
            this.task = '';
          },
          completedTask(item) {
            item.completed = true;
          },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
