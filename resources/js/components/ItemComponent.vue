<template>
  <li class="item">
    <span>[v{{ item.version }}]</span>
    <span>{{ releasedAt }}</span>
    <span>
      <a :href="item.url" target="_blank" rel="noopener">{{ item.url }}</a>
    </span>
    <ul>
      <info-component v-for="info in item.update_info" :info="info" :key="info.id"></info-component>
    </ul>
  </li>
</template>
<script>
import { DateTime } from "luxon";
export default {
  props: {
    item: {
      type: Object,
      default: {}
    }
  },
  computed: {
    releasedAt() {
      return this.item.released_at
        ? DateTime.fromISO(this.item.released_at).toFormat("yyyy/L/c")
        : "--";
    }
  }
};
</script>
<style scoped>
.item {
  border-bottom: solid 1px #ccc;
  margin-bottom: 0.5rem;
}
</style>
