<template>
<div id="backgroundImageContainer" class="container mt-5">
  <div class="row">
    <div class="col">
      <div v-if="this.list.length < 1" class="card card-body opaqueBackground mt-5">
        <h1 class="text-center p-3">You don't have a list to-do started today, just add a task to create your daily to-do list!</h1>
      </div>
      <ul class="list-group mt-5">
        <li class="list-group-item mt-1" v-for="(value, key, index) in displayList">
          <span :class="{ 'highPriority' : value.isHighPriority, 'completed' : value.isCompleted }">{{value.task}}</span>
          <span @click="completedTask(value)"><i class="fa fa-lg fa-check-square-o"></i></span>
          <span class="float-right" @click="removeTask(index)"><small>remove task</small></span>
        </li>
      </ul>
      <div class="card card-body mt-5 mb-5">
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
  </div>
</div>
</template>

<style>
.highPriority {
  color: red;
}

.completed {
  text-decoration: line-through;
}

#backgroundImageContainer {
  background-color: #cccccc;
}

.opaqueBackground {
  background-color: hsla(100, 100%, 100%, .5);
}
</style>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isHighPriority: false,
      task: '',
      list: [
        {task: 'brush teeth', isCompleted: false, isHighPriority: true},
        {task: 'wash face', isCompleted: false, isHighPriority: false},
        {task: 'pet puppy', isCompleted: true, isHighPriority: true},
        {task: 'get dressed', isCompleted: false, isHighPriority: false}
      ],
      backgroundImageSrc: '',
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
  computed: {
  displayList() {
    if(this.list) {
      let order = _.orderBy(this.list, ['isCompleted', 'isHighPriority'], ['aced','desc']);
      console.log(order);
      return order;
      } else {
      return [];
      }
    },

  },
  mounted() {
    console.log('mounted');
      let backgroundImage = axios.create({
        baseURL: 'https://source.unsplash.com/',
      });
      backgroundImage.get('daily?nature').then(function(response) {
        let backgroundImageProp = "url('" + response.request.responseURL + "')";
        console.log(backgroundImageProp);
        let element = document.getElementById("backgroundImageContainer");
        element.setAttribute("style", "background-image:" + backgroundImageProp);
      });
  },
}
</script>
