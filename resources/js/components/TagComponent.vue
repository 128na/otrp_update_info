<template>
  <el-button size="mini" type="primary" :style="style">{{ tag.name }}</el-button>
</template>
<script>
export default {
  props: {
    tag: {
      type: Object,
      default: {}
    }
  },
  computed: {
    style() {
      return {
        "background-color": `hsl(${this.tag.id * 100}, 50%, 50%)`,
        "border-color": `hsl(${this.tag.id * 100}, 50%, 40%)`,
        padding: ".1rem .3rem"
      };
    }
  }
};
</script>

