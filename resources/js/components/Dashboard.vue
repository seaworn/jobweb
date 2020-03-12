<template>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-dark sidebar py-5">
        <div class="sidebar-sticky">
          <h4 class="text-white">Dashboard</h4>
          <ul class="nav flex-column">
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'jobs'}">
                Jobs
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'roles'}">
                Roles
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'permissions'}">
                Permisions
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'users'}">
                Users
              </router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Reports
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="col-md-10">
        <div class="d-flex flex-md-nowrap align-items-right pb-2 mb-3">
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dashboard"
};
</script>

<style scoped>
</style>