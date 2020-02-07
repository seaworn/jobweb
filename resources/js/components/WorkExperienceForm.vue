<template>
  <div>
    <h3 class="font-weight-bold">Work Experience</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <div class="justify-content-center">
    <table class="table">
      <thead>
        <tr>
          
          <th>From</th>
          <th>To</th>
          <th>Position</th>
          <th>Organization</th>
          <th>Roles & Responsibilities</th>
        
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
      <td>
          
          <a href="#" ><i class='fa fa-edit'></i>Edit</a>
          <a href="#" ><i class="fa fa-trash"></i>Delete</a>


        </td>


       
      </tr>
      

    </table>
    
  </div>


    <form action method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="from">From</label>
          <input
            type="date"
            name="from"
            id="from"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.from"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="to">To</label>
          <input
            type="date"
            name="to"
            id="to"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.to"
          />
        </div>
      </div>
      <div class="form-group">
        <label for="position">Position</label>
        <input
          type="text"
          name="position"
          id="position"
          class="form-control"
          placeholder="e.g. Head of Security"
          v-model="formData.position"
        />
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
      <div class="form-group">
        <label for>Roles & Responsibilities</label>
        <textarea
          type="text"
          name="roles"
          id="roles"
          class="form-control"
          v-model="formData.roles"
          placeholder="e.g. Conducting safety awareness training, etc."
        ></textarea>
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "WorkExperienceForm",
  props: { eventBus: Vue },
  data() {
    return {
      formId: "experience",
      formData: {
        from: '',
        to: '',
        position: '',
        organization: '',
        roles: ''
      }
    }
  },
  methods: {
    handleSubmit() {
      this.$emit("validated", this);
    }
  }
}
</script>

<style scoped>
</style>