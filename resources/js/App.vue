<template>
  <el-container id="app">
    <el-header>
      <h1>OTRP 更新情報</h1>
      <a
        href="https://github.com/teamhimeh/simutrans/blob/OTRP-distribute/documentation/OTRP_v13_information.md"
        target="_blank"
        rel="noopener"
      >Document</a>
      <a href="https://osdn.net/projects/otrp/" target="_blank" rel="noopener">Download OTRP</a>
      <span>最終更新 {{ last_modified }}</span>
    </el-header>
    <el-container id="main">
      <el-aside>
        <div class="box">
          <h2>キーワード</h2>
          <el-input placeholder="検索" v-model="search_text" class="input-with-select">
            <el-button slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </div>
        <div class="box">
          <h2>タグ一覧</h2>
          <ul class="tags">
            <tag-component v-for="tag in data.tags" :key="tag.id" :tag="tag" />
          </ul>
        </div>
      </el-aside>
      <el-main>
        <h2>
          <span class="search-condition-title">検索条件:</span>
          <span v-show="!selected_tag && !selected_tag">すべて</span>
          <el-tag
            closable
            v-if="search_text"
            @close="removeSearchText"
            class="search-text"
          >keyword:{{ search_text }}</el-tag>
          <tag-component v-if="selected_tag" @close="removeTag" :tag="selected_tag" :list="false"></tag-component>
        </h2>
        <ul v-if="hasVersions" class="item-list">
          <item-component v-for="item in filtertedVersions" :key="item.id" :item="item" />
        </ul>
        <div v-else>ないです</div>
      </el-main>
    </el-container>
    <el-footer>
      <span>
        Created by
        <a href="https://twitter.com/128Na" target="_blank" rel="noopener">@128Na</a>
      </span>
      <span>
        GitHub :
        <a
          href="https://github.com/128na/otrp_update_info"
          target="_blank"
        >https://github.com/128na/otrp_update_info</a>
      </span>
    </el-footer>
  </el-container>
</template>
<script>
export default {
  data() {
    return {
      data: window.data,
      last_modified: window.last_modified,
      search_text: "",
      selected_tag: null
    };
  },
  computed: {
    filtertedVersions() {
      // 元データの参照を切る
      let versions = JSON.parse(JSON.stringify(this.data.versions));
      versions = this.filterBySelectedTag(versions);
      versions = this.filterBySearchText(versions);
      return versions;
    },
    hasVersions() {
      return this.filtertedVersions.length > 0;
    }
  },
  methods: {
    filterBySelectedTag(versions) {
      return this.selected_tag
        ? versions
            .map(v => {
              v.update_info = v.update_info.filter(i =>
                i.tags.some(t => t.id == this.selected_tag.id)
              );
              return v;
            })
            .filter(v => v.update_info.length > 0)
        : versions;
    },
    filterBySearchText(versions) {
      return this.search_text
        ? versions
            .map(v => {
              v.update_info = v.update_info.filter(i =>
                i.content.includes(this.search_text)
              );
              return v;
            })
            .filter(v => v.update_info.length > 0)
        : versions;
    },
    removeSearchText() {
      this.search_text = "";
    },
    removeTag() {
      this.selected_tag = null;
    }
  },
  mounted() {
    this.$gtm.trackView("Top", window.location.href);
    this.$bus.on("tag_selected", tag => {
      this.selected_tag = tag;
      this.$gtm.trackEvent({
        category: "Tag",
        action: "select",
        label: "Tag selcted",
        value: tag.name
      });
    });
  }
};
</script>
<style lang="scss" scoped>
a {
  word-break: break-all;
}
ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
h1 {
  font-size: 1.6rem;
  line-height: 3.2rem;
}
h2 {
  font-size: 1.2rem;
  line-height: 2.4rem;
}
#app {
  min-height: 100vh;
}
.box {
  margin-bottom: 1rem;
}
.el-header {
  background-color: #fff;
  border-bottom: solid 1px #ccc;
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  flex-wrap: wrap;
  a {
    margin: 0 1rem;
  }
  span {
    text-align: right;
    flex: 1;
  }
}
.el-main {
  padding: 1rem;
}
.el-aside {
  padding: 1rem 0 1rem 1rem;
}
.el-footer {
  padding: 1rem;
  background-color: #fff;
  border-top: solid 1px #ccc;
}
.el-button {
  margin-right: 8px;
}
.el-button + .el-button {
  margin-left: 0;
}
.search-condition-title {
  vertical-align: middle;
}
.el-tag .el-icon-close {
  color: #fff;
}
.el-tag .el-icon-close:hover {
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
}
.search-text {
  color: #fff;
  background-color: hsl(0, 50%, 50%);
  border-color: hsl(0, 50%, 40%);
}

@media only screen and (max-width: 768px) {
  #main {
    display: flex;
    flex-direction: column;
  }
  .el-header {
    height: auto !important;
    justify-content: center;
  }
  .el-aside {
    width: 100% !important;
    padding: 1rem;
  }
  .item-list,
  .box {
    display: flex;
    flex-direction: column;
  }
}
</style>
