<template>
  <div>
    <div>{{ info.id }}</div>
    <div>{{ info.version }}</div>
    <div>{{ info.content }}</div>
  </div>
</template>
<script>
export default {
  props: {
    versions: {
      type: Array,
      default: []
    },
    tags: {
      type: Array,
      default: []
    },
    info: {
      type: Object,
      default: {
        id: null,
        tags: [],
        version: null,
        content: null
      }
    }
  }
};
</script>
