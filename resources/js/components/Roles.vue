<template>
  <div>
    <!-- Modal Add New Role -->
    <modal id="roleEditor" @close="reset" size="lg">
      <template #title>{{values.id ? 'Modify' : 'Create'}} Role</template>
      <form method="POST" id="addRoleForm" @submit.prevent="handleSubmit" novalidate>
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            aria-describedby="nameHelp"
            v-model="values.name"
          />
        </div>
        <p>Permissions</p>
        <div class="border">
          <!-- <div class="d-flex flex-wrap justify-content-between">
            <form action class="form-inline">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Limit</span>
                </div>
                <select class="form-control" id="resource">
                  <option>1</option>
                </select>
              </div>
            </form>
          </div>-->
          <div class="d-flex flex-wrap p-2">
            <button
              type="button"
              class="btn btn-sm border rounded-pill m-1"
              v-for="permission in permissions"
              :key="permission.id"
              :class="{'btn-success' : values.permissions.find(perm => perm.id === permission.id)}"
              @click="togglePermission(permission)"
            >{{permission.name}}</button>
          </div>
          <pagination :paginator="paginator" @get-page="getPermissions($event)"></pagination>
        </div>
        <div class="form-group form-check my-2">
          <input
            type="checkbox"
            id="grantAll"
            class="form-check-input"
            name="grant_all_permissions"
            ref="grantAll"
            :value="values.grant_all_permissions"
            :checked="values.grant_all_permissions"
            @change="values.grant_all_permissions = !values.grant_all_permissions"
          />
          <label class="form-check-label" for="grantAll">Grant All Permisions</label>
        </div>
      </form>
      <template #actions>
        <button type="submit" form="addRoleForm" class="btn btn-primary">Submit</button>
      </template>
    </modal>
    <div class="d-flex justify-content-between py-1">
      <h3>Roles</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#roleEditor"
      >Add Role</button>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th>Permissions</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(role, idx) in roles" :key="role.id">
            <td>{{idx + 1}}</td>
            <td class="text-nowrap">{{role.name}}</td>
            <td>
              <div class="d-flex flex-wrap">
                <div
                  class="rounded-pill border shadow-sm p-1 pl-3 m-1"
                  v-for="permission in role.permissions"
                  :key="permission.id"
                >
                  <span>{{permission.name}}</span>&nbsp;
                  <button
                    type="button"
                    class="btn btn-sm rounded-circle xbtn"
                    @click="removePermission(role, permission)"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </td>
            <td>
              <div class="btn-group" role="group" aria-label>
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#roleEditor"
                  @click="edit(role)"
                >Edit</button>
                <button type="button" class="btn btn-danger" @click="delete_(role)">Delete</button>
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
const { default: Pagination } = require("./Pagination");

const defaultValues = {
  id: null,
  name: "",
  permissions: [],
  grant_all_permissions: false
};

export default {
  name: "Roles",
  mixins: [CRUDMixin],
  components: { Modal, Pagination },
  data() {
    return {
      roles: [],
      paginator: {},
      defaultValues,
      values: _.cloneDeep(defaultValues),
      resourceName: { single: "role", collection: "roles" },
      resourcePath: "/roles"
    };
  },
  computed: {
    permissions() {
      return this.paginator.data;
    },
    currentRole() {
      // Role currently being modified.
      return this.roles.find(role => role.id === this.values.id);
    }
  },
  created() {
    this.getPermissions();
  },
  methods: {
    edit(role) {
      this.values = {
        ...this.values,
        ..._.pick(role, ["id", "name", "permissions"])
      };
      this.values.permissions = this.filterAssignedPermissions(role);
    },
    togglePermission(permission) {
      const idx = this.values.permissions.findIndex(
        perm => perm.id === permission.id
      );
      if (idx === -1) {
        this.values.permissions.push(permission);
      } else {
        this.values.permissions.splice(idx, 1);
      }
    },
    getPermissions(page = 1) {
      axios
        .get(`/permissions`, { params: { page } })
        .then(response => {
          //console.log(response);
          this.paginator = response.data;
        })
        .catch(error => {
          //console.error(error.response);
        });
    },
    removePermission(role, permission) {
      axios
        .delete(`${this.resourcePath}/${role.id}/permissions/${permission.id}`)
        .then(response => {
          const idx = this.roles.indexOf(role);
          this.roles.splice(idx, 1, response.data.role);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          //console.error(error.response);
        });
    },
    filterAssignedPermissions(role) {
      // Filter permissions assigned to :role out of all permissions in current view/paginator.
      return _.cloneDeep(
        this.permissions.filter(perm =>
          role.permissions.map(perm => perm.id).includes(perm.id)
        )
      );
    }
  },
  watch: {
    "values.grant_all_permissions": function() {
      if (this.$refs.grantAll.checked === true) {
        this.values.permissions = [...this.permissions];
      } else if (currentRole) {
        this.values.permissions = this.filterAssignedPermissions(this.currentRole);
      } else {
        this.values.permissions = [];
      }
    },
    paginator() {
      let permissions = [];
      if (this.$refs.grantAll.checked === true) {
        permissions = this.permissions;
      } else if (currentRole) {
        permissions = filterAssignedPermissions(this.currentRole);
      }
      if (permissions.length) {
        permissions.map(
          perm =>
            !this.values.permissions.map(perm => perm.id).includes(perm.id) &&
            this.values.permissions.push(perm)
        );
      }
    }
  }
};
</script>

<style scoped>
</style>