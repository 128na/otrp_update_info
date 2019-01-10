<template>
  <div>
    <version-component
      v-for="version in versions"
      :key="version.id"
      :info="relatedUpdateInfo(version)"
      :tags="tags"
      :versions="versions"
    />
  </div>
</template>
<script>
export default {
  data() {
    return {
      tags: window.data.tags || [],
      versions: window.data.versions || [],
      update_info: window.data.update_info || []
    };
  }
};
</script>
