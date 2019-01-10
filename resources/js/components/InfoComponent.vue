<template>
  <div class="box">
    <span class="content">{{ info.content }}</span>
    <span>
      <tag-component v-for="tag in info.tags" :tag="tag" :key="tag.id"></tag-component>
    </span>
  </div>
</template>
<script>
export default {
  props: {
    info: {
      type: Object,
      default: {}
    }
  }
};
</script>
<style scoped>
.box {
  margin: 0 0 0 1rem;
}
.content {
  white-space: pre;
}
</style>

