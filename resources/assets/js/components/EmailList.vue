<template>
  <div class="card card-body opaqueBackground mt-4 mb-5">
    <h3 id="emailTasks"><i class="fa fa-envelope"></i> Email me this</h3>
    <h4 v-if="showEmailSuccess" class="text-info">Successfully Sent!</h4>
    <form>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <span class="input-group-addon text-info clickable" @click="emailTasks()">SEND</span>
          <input v-model="email" class="form-control" type="email" placeholder="email" aria-label="email" aria-describedby="email">
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: [],
  data() {
    return {
      email: '',
      showEmailSuccess: false,
    };
  },
  computed: {
    displayList() {
        return _.orderBy(this.list, ['isCompleted', 'isHighPriority'], ['aced', 'desc']);
      },
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
}
</script>
