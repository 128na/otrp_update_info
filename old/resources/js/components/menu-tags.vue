<template>
  <div>
    <b-button
      v-for="tag in value"
      :key="tag.id"
      :variant="variant(tag.id)"
      size="sm"
      class="mr-1 mb-1"
      @click="handleClick(tag.id)"
    >{{ tag.name }}</b-button>
  </div>
</template>
<script>
export default {
  props: ["value", "selected"],
  methods: {
    isSelected(tag_id) {
      return this.selected.includes(tag_id);
    },
    variant(tag_id) {
      return this.isSelected(tag_id) ? "success" : "outline-secondary";
    },
    handleClick(tag_id) {
      if (this.isSelected(tag_id)) {
        const index = this.selected.indexOf(tag_id);
        this.selected.splice(index, 1);
      } else {
        this.selected.push(tag_id);
      }
    }
  }
};
</script>
