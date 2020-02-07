<template>
  <div>
    <h2 class="font-weight-bold">Professional Memberships</h2>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <div class="justify-content-center">
    <table class="table">
      <thead>
        <tr>
          <th>Professional Body</th>
          <th>Membership Reg  No.</th>
          <th>Membership</th>
          <th>Membership Type</th>
          <th>Membership Expiry Date</th>
          
          <th colspan="2">Action</th>
        </tr>
      </thead>
     
      <tr>
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
      <div class="form-group">
        <label for="body">Professional Body</label>
        <input
          type="text"
          name="body"
          id="body"
          class="form-control"
          placeholder="e.g. Institution of Engineers of Kenya"
          v-model="formData.body"
        />
      </div>
      <div class="form-group">
        <label for="regNo">Reg. No</label>
        <input
          type="text"
          name="regNo"
          id="regNo"
          class="form-control"
          placeholder="Registration number"
          v-model="formData.regNo"
        />
      </div>
      <div class="form-group">
        <label for="membershipType">Membership Type</label>
        <input
          type="text"
          name="membershipType"
          id="membershipType"
          class="form-control"
          placeholder="e.g. Consultant"
          v-model="formData.membershipType"
        />
      </div>
      <div class="form-group">
        <label for="expiry">Expiry</label>
        <input
          type="date"
          name="expiry"
          id="expiry"
          class="form-control"
          placeholder="MM/DD/YYYY"
          v-model="formData.expiry"
        />
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ProfessionalMembershipForm',
  props: { eventBus: Vue },
  data() {
    return {
      formId: 'memberships',
      formData: {
        body: '',
        regNo: '',
        membershipType: '',
        expiry: ''
      }
    };
  },
  methods: {
    handleSubmit() {this.$emit('validated', this);}
  }
};
</script>

<style scoped>
</style>