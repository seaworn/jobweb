<template>
  <div>
    <div id="navigation" class="d-flex justify-content-center my-4">
      <button
        type="button"
        class="btn shadow mx-2 rounded-circle"
        v-for="(_, idx) in forms"
        :key="idx"
        @click="currentIndex = idx"
        :class="[idx === currentIndex ? 'btn-success' : 'btn-secondary']"
      >{{idx + 1}}</button>
    </div>
    <component :is="currentForm" />
    <div class="d-flex flex-row-reverse">
      <button type="button" class="btn btn-success" @click="next">Next</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserProfileForm",
  data: function() {
    return {
      eventBus: new Vue({}),
      currentIndex: 0,
      forms: [
        require("./PersonalInformationForm").default,
        require("./ContactPersonForm").default,
        require("./AcademicQualificationForm").default,
        require("./WorkExperienceForm").default,
        require("./ProfessionalCertificationForm").default,
        require("./ProfessionalMembershipForm").default,
        require("./SkillForm").default,
        require("./RefereeForm").default
      ]
    };
  },
  computed: {
    currentForm: function() {
      return this.forms[this.currentIndex];
    },
    atEnd: function() {
      return this.currentIndex === this.forms.length - 1;
    }
  },
  methods: {
    next: function() {
      this.atEnd ? (this.currentIndex = 0) : this.currentIndex++;
    }
  }
};
</script>

<style scoped>
</style>