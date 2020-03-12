<template>
  <nav aria-label="Pagination" class="d-flex">
    <ul class="pagination mx-auto">
      <li class="page-item" v-for="pageNo in pages" :key="pageNo">
        <a
          class="page-link"
          :href="`${paginator.path}?page=${pageNo}`"
          @click.prevent="$emit('get-page', pageNo)"
          :class="{'bg-primary text-white': pageNo === paginator.current_page}"
        >{{pageNo}}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
const { range } = require("lodash");

export default {
  props: { paginator: { type: Object, required: true } },
  computed: {
    pages() {
      return range(1, this.paginator.last_page + 1);
    }
  }
};
</script>

<style>
</style>