<template>
<div id="backgroundImageContainer" class="container mt-2">
  <div class="row">
    <div class="col">
      <h2 class="mt-3">
        The List

        <icon-nav></icon-nav>
      </h2>

      <list :list="list"></list>

      <add-task :list="list"></add-task>

      <email-list :list="list"></email-list>

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
    }
  },
  mounted() {
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
