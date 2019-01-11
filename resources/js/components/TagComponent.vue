<template>
  <el-button
    size="mini"
    type="primary"
    :style="buttonStyle"
    @click="click"
    v-if="list"
  >{{ tag.name }}</el-button>
  <el-tag closable type="primary" :style="tagStyle" @close="$emit('close')" v-else>{{ tag.name }}</el-tag>
</template>
<script>
export default {
  props: {
    tag: {
      type: Object
    },
    list: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    style() {
      return {
        "background-color": `hsl(${this.tag.id * 110}, 50%, 50%)`,
        "border-color": `hsl(${this.tag.id * 110}, 50%, 40%)`
      };
    },
    tagStyle() {
      return Object.assign(this.style, {
        color: "#fff"
      });
    },
    buttonStyle() {
      return Object.assign(this.style, {
        padding: ".1rem .3rem"
      });
    }
  },
  methods: {
    click() {
      this.$bus.emit("tag_selected", this.tag);
    }
  }
};
</script>

