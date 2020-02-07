<template>
  <div>
    <h3 class="font-weight-bold">Referees</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <div class="justify-content-center">
    <table class="table">
      <thead>AddressPhone Number EmailHow long have known each other?
        <tr>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Other Name</th>
          <th>Organization</th>
          <th>Address</th>
          <th>Phone No</th>
          <th>Email Address</th>
          <th>Relationship</th>
          <th>Time Relationship</th>
          
          <th colspan="2">Action</th>
        </tr>
      </thead>
      
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
      <td>
          
          <a href="#" ><i class='fa fa-edit'></i>Edit</a>
          <a href="#" ><i class="fa fa-trash"></i>Delete</a>


        </td>
      </tr>
      

    </table>
    
  </div>


    <form action="" method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="firstName">First Name</label>
          <input
            type="text"
            name="firstName"
            id="firstName"
            class="form-control"
            placeholder="First Name"
            v-model="formData.firstName"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="middleName">Middle Name</label>
          <input
            type="text"
            name="middleName"
            id="middleName"
            class="form-control"
            placeholder="Middle Name"
            v-model="formData.middleName"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="otherName">Other Name</label>
          <input
            type="text"
            name="otherName"
            id="otherName"
            class="form-control"
            placeholder="Other Name"
            v-model="formData.otherName"
          />
        </div>
      </div>
      <div class="form-group">
        <label for="organization">Organization</label>
        <input
          type="text"
          name="organization"
          id="organization"
          class="form-control"
          placeholder="e.g. JobWeb"
          v-model="formData.organization"
        />
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="address">Address</label>
          <input
            type="date"
            name="address"
            id="address"
            class="form-control"
            placeholder="e.g. 010-00100, Nairobi"
            v-model="formData.address"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="phoneNo">Phone Number</label>
          <input
            type="telephone"
            name="phoneNo"
            id="phoneNo"
            class="form-control"
            placeholder="e.g. 07********"
            v-model="formData.phoneNo"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="formData.email"
          />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="relationship">Relationship</label>
          <input
            type="text"
            name="relationship"
            id="relationship"
            class="form-control"
            placeholder="e.g. Supervisor"
            v-model="formData.relationship"
          />
        </div>
        <div class="form-group col-md-6">
          <label for="lengthOfRelationship">How long have known each other?</label>
          <input
            type="text"
            name="lengthOfRelationship"
            id="lengthOfRelationship"
            class="form-control"
            placeholder="e.g. 3 Years"
            v-model="formData.lengthOfRelatioship"
          />
        </div>
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'RefereeForm',
  props: { eventBus: Vue },
  data() {
    return {
      formId: 'referees',
      formData: {
        firstName: '',
        middleName: '',
        otherName: '',
        organization: '',
        address: '',
        phoneNo: '',
        email: '',
        relationship: '',
        lengthOfRelationship: ''
      }
    }
  },
  methods: {
    handleSubmit() {this.$emit('validated', this)}
  }
}
</script>

<style scoped>
</style>