<template>
  <main>
    <nav-header :last_modified="last_modified" />
    <b-container class="py-4 border-bottom">
      <btn-collapse :visible="visible_tags" collapse_id="menu-tags">タグ一覧</btn-collapse>
      <btn-collapse :visible="visible_search" collapse_id="menu-search">キーワード検索</btn-collapse>

      <collapse-content collapse_id="menu-tags" :visible="visible_tags">
        <menu-tags v-model="tags" :selected="selected" />
      </collapse-content>
      <collapse-content collapse_id="menu-search" :visible="visible_search">
        <menu-search v-model="word" />
      </collapse-content>
    </b-container>
    <b-container class="py-2 border-bottom">
      <menu-condition :tags="tags" :selected="selected" :word="word" @clear="handleClear" />
    </b-container>
    <b-container class="versions">
      <body-items :versions="filtered_versions" :selected="selected" />
    </b-container>
    <nav-footer />
  </main>
</template>
<script>
import { DateTime } from "luxon";
export default {
  data() {
    return {
      tags: [],
      versions: [],
      last_modified: null,
      word: "",
      selected: [],
      visible_tags: true,
      visible_search: false
    };
  },
  created() {
    this.tags = window.data.tags;
    this.versions = window.data.versions.map(version => {
      version.released_at = DateTime.fromISO(version.released_at).toISODate();
      return version;
    });
    this.last_modified = window.last_modified;
  },
  mounted() {
    this.$root.$on("bv::collapse::state", (id, state) => {
      switch (id) {
        case "menu-tags":
          return (this.visible_tags = state);
        case "menu-search":
          return (this.visible_search = state);
      }
    });
  },
  methods: {
    filterBySelected(versions) {
      return versions
        .map(version =>
          Object.assign({}, version, {
            update_info: version.update_info.filter(info =>
              this.selected.every(tag_id =>
                info.tags.find(tag => tag.id == tag_id)
              )
            )
          })
        )
        .filter(version => version.update_info.length);
    },
    filterByWord(versions) {
      return versions
        .map(version =>
          Object.assign({}, version, {
            update_info: version.update_info.filter(info =>
              info.content.includes(this.word)
            )
          })
        )
        .filter(version => version.update_info.length);
    },
    handleClear() {
      this.word = "";
      this.selected = [];
    }
  },
  computed: {
    filtered_versions() {
      let versions = this.versions;
      if (this.selected.length) {
        versions = this.filterBySelected(versions);
      }
      if (this.word) {
        versions = this.filterByWord(versions);
      }
      return versions;
    }
  }
};
</script>
<style lang="scss" scoped>
main {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  .versions {
    flex: 1;
  }
}
</style>
