<template>
  <b-button :variant="variant" @click="handle">
    <transition name="rotation" mode="out-in">
      <b-icon v-if="visible" icon="caret-up-fill" key="a" />
      <b-icon v-else icon="caret-down-fill" key="b" />
    </transition>
    <slot />
  </b-button>
</template>
<script>
export default {
  props: ["visible", "collapse_id"],
  computed: {
    variant() {
      return this.visible ? "primary" : "outline-secondary";
    }
  },
  methods: {
    handle() {
      this.$root.$emit("bv::toggle::collapse", this.collapse_id);
    }
  }
};
</script>
<style scoped>
.rotation-leave-active {
  transition: transform 0.25s ease;
}
.rotation-leave-to {
  transform: rotate(180deg);
}
</style>
