<template>
  <component :is="currentForm" :event-bus="eventBus" @validated="nextForm"></component>
</template>

<script>
const PersonalInformationForm = require("./PersonalInformationForm.vue").default;
const AcademicQualificationForm = require("./AcademicQualificationForm.vue").default;
const WorkExperienceForm = require("./WorkExperienceForm.vue").default;
const ProfessionalCertificationForm = require("./ProfessionalCertificationForm.vue").default;
const ProfessionalMembershipForm = require("./ProfessionalMembershipForm.vue").default;
const SkillForm = require("./SkillForm.vue").default;
const RefereeForm = require("./RefereeForm.vue").default;

export default {
  name: "UserProfileForm",
  data() {
    return {
      forms: [
        PersonalInformationForm,
        AcademicQualificationForm,
        ProfessionalCertificationForm,
        SkillForm,
        ProfessionalMembershipForm,
        WorkExperienceForm,
        RefereeForm
      ],
      formData: {},
      currentIndex: 0,
      eventBus: new Vue({}),
    };
  },
  computed: {
    currentForm() {
      return this.forms[this.currentIndex];
    },
    atEnd() {
      return this.currentIndex === this.forms.length - 1;
    }
  },
  methods: {
    nextForm(currentForm) {
      this.formData[currentForm.formId] = currentForm.formData;
      if (this.atEnd) {
        this.submitCompleteForm();
      } else {
        this.currentIndex++;
      }
    },
    async submitCompleteForm() {
      try {
        console.log(this.formData);
        const response = await axios.post("api/create-profile", this.formData);
        alert(JSON.stringify(response.data, undefined, 2));
      } catch (error) {
        console.log(error.response);
      }
    }
  }
}
</script>

<style scoped>

</style>