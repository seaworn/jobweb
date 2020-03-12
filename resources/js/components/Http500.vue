<template>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1>500 - Server Error!</h1>
      <hr class="my-2" />
      <p class="lead">
        Sorry! A fatal error has occured on the server.
        <router-link :to="{name: 'index'}">Go back home</router-link>.
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: "Http500"
};
</script>
<style scoped>
</style>