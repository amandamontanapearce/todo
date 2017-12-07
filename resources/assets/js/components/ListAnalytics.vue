<template>
  <div class="card card-body opaqueBackground mt-4 mb-5">
    <h3 id="analytics">How are you doing? List statistics. <i class="fa fa-line-chart"></i></h3>
    <p>You've complete {{percentComplete}}% of your tasks! <span v-if="percentComplete > 90"> Great Job!</span></p>
    <p>{{percentHighPriority}}% of your tasks are high priority.</p>
  </div>
</template>

<script>
export default {
  props: ['list'],
  computed: {
    percentComplete() {
      return _.filter(this.list, ['isCompleted', true]).length / this.list.length;
    },
    percentHighPriority() {
      return _.filter(this.list, ['isHighPriority', true]).length / this.list.length;
    },
  },
}
</script>
