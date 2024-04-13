<template>
  <b-collapse :id="collapse_id" :visible="visible" class="mt-2">
    <slot />
  </b-collapse>
</template>
<script>
export default {
  props: ["collapse_id", "visible"]
};
</script>
