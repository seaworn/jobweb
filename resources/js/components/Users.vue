<template>
  <div>
    <modal id="userEditor" @close="reset">
      <template v-slot:title>{{values.id ? 'Modify' : 'Create'}} User</template>
      <form method="POST" id="addUserForm" @submit.prevent="handleSubmit" novalidate>
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            name="username"
            class="form-control"
            id="username"
            v-model="values.username"
            aria-describedby="usernameHelp"
          />
        </div>
        <div class="form-group">
          <label for="email">Email Adress</label>
          <input
            type="text"
            name="email"
            class="form-control"
            id="email"
            v-model="values.email"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            v-model="values.password"
            aria-describedby="passwordHelp"
          />
        </div>
        <div class="form-group">
          <label>Roles</label>
          <br />
          <div class="form-check" v-for="role in roles" :key="role.id">
            <input
              type="checkbox"
              class="form-check-input"
              name="role"
              :id="role.name"
              :value="role.id"
              :checked="values.roles.find(r => r.id === role.id)"
              @change="syncRoles($event, role)"
            />
            <label :for="role.name" class="form-check-label">{{role.name}}</label>
          </div>
        </div>
      </form>
      <template v-slot:actions>
        <button type="submit" form="addUserForm" class="btn btn-primary">Submit</button>
      </template>
    </modal>
    <div class="d-flex justify-content-between py-1">
      <h4>Users</h4>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#userEditor"
      >Add User</button>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th></th>
            <th>Username</th>
            <th>Email Adress</th>
            <th>Roles</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, idx) in users" :key="user.id">
            <td>{{idx + 1}}</td>
            <td>{{user.username}}</td>
            <td>{{user.email}}</td>
            <th>
              <div class="d-flex flex-wrap">
                <span
                  v-for="role in user.roles"
                  :key="role.id"
                  class="rounded-pill shadow-sm py-1 px-2 m-1"
                >{{role.name}}</span>
              </div>
            </th>
            <td>
              <div class="btn-group" role="group" aria-label>
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#userEditor"
                  @click="editUser(user)"
                >Edit</button>
                <button type="button" class="btn btn-danger" @click="delete_(user)">Delete</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
const _ = require("lodash");
const { CRUDMixin } = require("./mixins");
const { default: Modal } = require("./Modal");

const defaultValues = {
  id: null,
  username: "",
  email: "",
  password: "",
  roles: []
};

export default {
  name: "Users",
  mixins: [CRUDMixin],
  components: { Modal },
  data() {
    return {
      users: [],
      roles: [],
      defaultValues,
      values: _.cloneDeep(defaultValues),
      resourceName: { single: "user", collection: "users" },
      resourcePath: "/users"
    };
  },
  created() {
    axios
      .get("/roles")
      .then(response => {
        // console.log(response);
        this.roles = response.data;
      })
      .catch(error => {
        // console.error(error.response);
      });
  },
  methods: {
    editUser(user) {
      this.values = {
        ...this.values,
        ..._.pick(user, ["id", "username", "email"])
      };
      this.values.roles = user.roles.map(role => role.id);
    },
    syncRoles(event, role) {
      if (event.target.checked === true) {
        this.values.roles.push(role.name);
      } else {
        this.values.roles = this.values.roles.filter(
          value => value !== role.name
        );
      }
    }
  }
};
</script>

<style scoped>
</style>