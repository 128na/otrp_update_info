<template>
  <li>
    <span>[{{ item.version }}]</span>
    <span>{{ item.released_at }}</span>
    <ul>
      <info-component v-for="info in item.update_info" :info="info" :key="info.id"></info-component>
    </ul>
  </li>
</template>
<script>
export default {
  props: {
    item: {
      type: Object,
      default: {}
    }
  }
};
</script>
<style scoped>
li {
  border-bottom: solid 1px #000;
}
</style>
