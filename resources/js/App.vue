<template>
  <el-container>
    <el-header>Header</el-header>
    <el-container>
      <el-aside width="200px">
        <ul>
          <tag-component v-for="item in tags" :key="item.id" :item="item"/>
        </ul>
      </el-aside>
      <el-main>
        <ul>
          <item-component v-for="item in filtertedData" :key="item.id" :item="item"/>
        </ul>
      </el-main>
    </el-container>
  </el-container>
</template>
<script>
export default {
  data() {
    return {
      data: window.data
    };
  },
  // async created() {
  //   const res = await axios.get("/storage/1/data.json");
  //   console.log(res.data);
  //   this.data = data;
  // },
  computed: {
    filtertedData() {
      return this.data;
    },
    tags() {
      const tags = this.data.map(v => v.update_info.map(i => i.tags)).flat(2);
      console.log(tags);

      return [];
    }
  }
};
</script>
<style>
ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
</style>
