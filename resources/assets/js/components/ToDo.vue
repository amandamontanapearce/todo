<template>
<div id="backgroundImageContainer" class="container mt-3">
<div class="row">
<div class="col">
<div v-if="this.list.length < 1" class="card card-body opaqueBackground mt-5">
<h1 class="text-center p-3">You don't have a list to-do started today, just add a task to create your daily to-do list!</h1>
</div>
  <ul class="list-group mt-5" v-for="(value, key, index) item in list">
    <li class="list-group-item" v-if="!value.isCompleted">
      <span :class="{ 'highPriority' : value.isHighPriority }">{{value.task}}</span>
      <span @click="completedTask(value)"><i class="fa fa-check-square-o"></i></span>
      <span class="float-right" @click="removeTask(index)">remove task</span>
    </li>
  </ul>
  <ul class="list-group mt-5" v-for="item in list">
    <li class="list-group-item" v-if="item.isCompleted">
      <strike :class="{ 'highPriority' : item.isHighPriority }">{{item.task}}</strike>
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
      list: [],
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
  mounted() {
    console.log('mounted');
    if(this.list.length < 1) {
      let backgroundImage = axios.create({
      baseURL: 'https://source.unsplash.com/',

      });
      backgroundImage.get('daily?nature').then( function(response) {
      let backgroundImageProp = "url('" + response.request.responseURL + "')";
      console.log(backgroundImageProp);
      let element = document.getElementById("backgroundImageContainer");
      element.setAttribute("style", "background-image:" + backgroundImageProp);
      });
    }
  },
}
</script>
