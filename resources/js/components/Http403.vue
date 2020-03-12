<template>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1>403 - Forbidden!</h1>
      <hr class="my-2" />
      <p class="lead">
        You are not authorized to view this page.
        <router-link :to="{name: 'index'}">Go back home</router-link>.
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "Http403"
};
</script>

<style scoped>
</style>