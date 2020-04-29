<template>
  <a target="_blank" rel="noopener noreferrer" :href="href">
    <b-icon v-if="!no_icon" icon="box-arrow-up-right" />
    <slot />
  </a>
</template>
<script>
export default {
  props: ["href", "no_icon"]
};
</script>
