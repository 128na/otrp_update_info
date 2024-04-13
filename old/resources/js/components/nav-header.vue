<template>
  <b-navbar toggleable="md" type="light" variant="light" class="menu-header border-bottom">
    <b-container>
      <b-navbar-brand href="./">OTRP 更新情報</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-text class="px-2">
            <external-link
              href="https://github.com/teamhimeh/simutrans/blob/OTRP-distribute/documentation/OTRP_v13_information.md"
            >Document</external-link>
          </b-nav-text>
          <b-nav-text class="px-2">
            <external-link href="https://osdn.net/projects/otrp/">Download OTRP</external-link>
          </b-nav-text>
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto">
          <b-nav-item>{{ last_modified }}更新</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-container>
  </b-navbar>
</template>
<script>
export default {
  props: ["last_modified"]
};
</script>
