<template>
  <transition-group name="list-complete">
    <div
      v-for="version in versions"
      :key="version.id"
      class="mx-n3 px-3 p-2 border-bottom item list-complete-item"
    >
      <div class="mb-1">
        <strong>v{{version.version}}</strong>
        <span>{{version.released_at}}</span>
        <span>
          <external-link :href="version.url">Link</external-link>
        </span>
      </div>
      <div v-for="info in version.update_info" :key="info.id">
        <div>
          <b-button
            v-for="tag in info.tags"
            :key="tag.id"
            :variant="variant(tag.id)"
            size="sm"
            class="mb-1 mr-1"
            @click="handleClick(tag.id)"
          >{{tag.name}}</b-button>
        </div>
        <div class="ml-2 mb-2">
          <span>{{info.content}}</span>
        </div>
      </div>
    </div>
    <div v-if="!versions.length" class="my-2" key="none">該当なし</div>
  </transition-group>
</template>
<script>
export default {
  props: ["versions", "selected"],
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
<style lang="scss" scoped>
.item {
  &:hover {
    background-color: var(--light);
  }
}
.list-complete-item {
  transition: all 0.5s;
  background-color: var(--white);
}
.list-complete-enter,
.list-complete-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
  position: absolute;
}
</style>
