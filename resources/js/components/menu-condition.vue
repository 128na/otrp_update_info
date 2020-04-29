<template>
  <div class="d-flex flex-wrap">
    <div class="f1">条件: {{ condition }}</div>
    <div>
      <b-button
        v-if="has_condition"
        variant="outline-danger"
        size="sm"
        @click="$emit('clear')"
      >条件クリア</b-button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["tags", "selected", "word"],
  computed: {
    has_condition() {
      return this.selected.length || this.word;
    },
    condition() {
      let label = [];
      if (this.selected.length) {
        label = label.concat(
          this.tags.filter(t => this.selected.includes(t.id)).map(t => t.name)
        );
      }
      if (this.word) {
        label.push(`「${this.word}」`);
      }
      return label.length ? label.join("、") : "全て";
    }
  }
};
</script>
<style scoped>
.f1 {
  flex: 1;
}
</style>
