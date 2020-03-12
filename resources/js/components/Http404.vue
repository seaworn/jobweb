<template>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1>404 - Not Found!</h1>
      <hr class="my-2" />
      <p class="lead">
        The requested page does not exist.
        <router-link :to="{name: 'index'}">Go back home</router-link>.
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "Http404"
};
</script>

<style scoped>
</style>