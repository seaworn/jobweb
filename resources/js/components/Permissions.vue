<template>
  <div>
    <modal id="permissionEditor" @close="reset">
      <template #title>{{values.id ? 'Modify' : 'Create'}} Permission</template>
      <form method="POST" id="addPermissionForm" @submit.prevent="handleSubmit" novalidate>
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            v-model="values.name"
            aria-describedby="nameHelp"
          />
        </div>
      </form>
      <template #actions>
        <button type="submit" form="addPermissionForm" class="btn btn-primary">Submit</button>
      </template>
    </modal>
    <div class="d-flex justify-content-between py-1">
      <h3>Permissions</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#permissionEditor"
      >Add Permission</button>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(permission, idx) in permissions" :key="permission.id">
            <td>{{idx + 1}}</td>
            <td class="text-nowrap">{{permission.name}}</td>
            <td>
              <div class="btn-group" role="group" aria-label>
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#permissionEditor"
                  @click="edit(permission)"
                >Edit</button>
                <button type="button" class="btn btn-danger" @click="delete_(permission)">Delete</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :paginator="paginator" @get-page="getPage($event)"></pagination>
    </div>
  </div>
</template>

<script>
const _ = require("lodash");
const { CRUDMixin } = require("./mixins");
const { default: Modal } = require("./Modal");
const { default: Pagination } = require("./Pagination");

const defaultValues = {
  id: null,
  name: ""
};

export default {
  name: "Permissions",
  components: { Modal, Pagination },
  mixins: [CRUDMixin],
  data() {
    return {
      paginator: {},
      defaultValues,
      values: { ...defaultValues },
      resourceName: { single: "permission", collection: "permissions" },
      resourcePath: "/permissions"
    };
  },
  computed: {
    permissions: {
      get() {
        return this.paginator.data;
      },
      set(value) {
        this.paginator = value;
      }
    }
  },
  methods: {
    edit(permission) {
      this.values = { ...this.values, ..._.pick(permission, ["id", "name"]) };
    },
    getPage(page = 1) {
      axios
        .get(`${this.paginator.path}`, { params: { page } })
        .then(response => {
          //console.log(response);
          this.paginator = response.data;
        })
        .catch(error => {
          //console.error(error.response);
        });
    }
  }
};
</script>

<style scoped>
</style>