<template>
  <div>
    <ul>
      <item-component v-for="item in filtertedData" :key="item.id" :item="item"/>
    </ul>
  </div>
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
