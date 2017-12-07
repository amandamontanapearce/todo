<template>
<div id="backgroundImageContainer" class="container mt-2">
  <div class="row">
    <div class="col">
      <h2 class="mt-3">
      The List
      <icon-nav></icon-nav>
      </h2>
      <div v-if="this.list.length < 1" class="card card-body opaqueBackground">
        <h1 class="text-center p-3">You don't have a list to-do started today, just add a task to create your daily to-do list!</h1>
      </div>
      <list :list="list"></list>
      <add-task :list="list"></add-task>
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
    <list-analytics :list="list"></list-analytics>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
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
