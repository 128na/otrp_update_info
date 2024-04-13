<template>
  <div>
    <b-form-group label="キーワード">
      <b-form-input v-model="computed_word" />
    </b-form-group>
  </div>
</template>
<script>
export default {
  props: ["value"],
  computed: {
    computed_word: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit("input", val);
      }
    }
  }
};
</script>
