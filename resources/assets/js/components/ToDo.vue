<template>
<div id="backgroundImageContainer" class="container mt-2">
  <div class="row">
    <div class="col">
      <h2 class="mt-3">
      The List
      <a href="#addToTask">
        <span class="float-right">
          <i class="fa fa-plus px-3 text-info"></i>
        </span>
      </a>
      <a href="#emailTasks">
        <span class="float-right">
          <i class="fa fa-envelope px-3 text-info"></i>
        </span>
      </a>
      </h2>
      <div v-if="this.list.length < 1" class="card card-body opaqueBackground">
        <h1 class="text-center p-3">You don't have a list to-do started today, just add a task to create your daily to-do list!</h1>
      </div>
      <ul class="list-group mt-1">
        <li class="list-group-item opaqueBackground mt-1" v-for="(value, key, index) in displayList">
          <span :class="{ 'highPriority' : value.isHighPriority, 'completed' : value.isCompleted }">{{value.task}}</span>
          <span class="px-3" @click="completedTask(value)"><i class="fa fa-lg fa-check-square-o"></i></span>
          <span class="float-right" @click="removeTask(value.task)"><small>remove task</small></span>
        </li>
      </ul>
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
      <div class="card card-body opaqueBackground mt-4 mb-5">
        <h3 id="emailTasks">Email me this <i class="fa fa-mail-forward"></i></h3>
        <h4 v-if="showEmailSuccess" class="text-info">Successfully Sent!</h4>
        <form>
          <div class="form-group">
            <div class="input-group input-group-lg">
              <span class="input-group-addon text-info" @click="emailTasks()">SEND</span>
              <input v-model="email" class="form-control" type="email" placeholder="email" aria-label="email" aria-describedby="email">
            </div>
          </div>
        </form>
      </div>
      <div class="card card-body opaqueBackground mt-4 mb-5">
        <h3>How are you doing? List statistics. <i class="fa fa-line-chart"></i></h3>
        <p>You've complete {{percentComplete}}% of your tasks! <span v-if="percentComplete > 90"> Great Job!</span></p>
        <p>{{percentHighPriority}}% of your tasks are high priority.</p>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isHighPriority: false,
      task: '',
      // prepopulated list for development only
      list: [{
          task: 'brush teeth',
          isCompleted: false,
          isHighPriority: true
        },
        {
          task: 'wash face',
          isCompleted: false,
          isHighPriority: false
        },
        {
          task: 'pet puppy',
          isCompleted: true,
          isHighPriority: true
        },
        {
          task: 'get dressed',
          isCompleted: false,
          isHighPriority: false
        }
      ],
      backgroundImageSrc: '',
      email: '',
      showEmailSuccess: false,
    }
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
    completedTask(item) {
      item.isCompleted = true;
    },
    removeTask(task) {
      let taskIndex = this.list.indexOf( _.find( this.list, {'task': task}) );
      this.list.splice(taskIndex, 1);
    },
    buildString() {
      let string = '<ul>';
      _.forEach(this.displayList, function(value) {
        if (value.isCompleted) {
          string = string + '<li>' + value.task + ': done</li>';
        } else {
          string = string + '<li>' + value.task + ': not done yet ;) </li>';
        }
      });
      return string + '</ul>';
    },
    emailTasks() {
      let templateParameters = {
        messageHTML: this.buildString(),
      };
      let serviceId = "gmail";
      let templateId = "template_emailtodo";
      // basic validation, should be replaces with validation library
      if (this.email.length > 4) {
        var self = this;
        emailjs.send(serviceId, templateId, templateParameters)
          .then(function(response) {
            self.showEmailSuccess = true;
            console.log("SUCCESS. status=%d, text=%s", response.status, response.text);
          }, function(err) {
            console.log("FAILED. error=", err);
          });
      }
    },
  },
  computed: {
    displayList() {
        return _.orderBy(this.list, ['isCompleted', 'isHighPriority'], ['aced', 'desc']);
    },
    percentComplete() {
      return _.filter(this.list, ['isCompleted', true]).length / this.list.length;
    },
    percentHighPriority() {
      return _.filter(this.list, ['isHighPriority', true]).length / this.list.length;
    },
  },
  mounted() {
    console.log('mounted');
    let backgroundImage = axios.create({
      baseURL: 'https://source.unsplash.com/',
    });
    backgroundImage.get('daily?nature').then(function(response) {
      let backgroundImageProp = "url('" + response.request.responseURL + "')";
      let element = document.getElementById("backgroundImageContainer");
      element.setAttribute("style", "background-image:" + backgroundImageProp);
    });
  },
}
</script>
