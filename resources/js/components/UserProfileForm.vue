<template>
  <div>
    <div id="navigation" class="d-flex justify-content-center my-4">
      <button
        type="button"
        class="btn shadow mx-2"
        v-for="(_, idx) in forms"
        :key="idx"
        @click="currentIndex = idx"
        :class="[idx === currentIndex ? 'btn-success' : 'btn-secondary']"
      >{{idx + 1}}</button>
    </div>
    <component :is="currentForm" :event-bus="eventBus" @next="next"/>
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
        require("./PersonalInformationForm.vue").default,
        require("./AcademicQualificationForm.vue").default,
        require("./WorkExperienceForm.vue").default,
        require("./ProfessionalCertificationForm.vue").default,
        require("./ProfessionalMembershipForm.vue").default,
        require("./SkillForm.vue").default,
        require("./RefereeForm.vue").default
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
      this.atEnd ? this.currentIndex = 0 : this.currentIndex++;
    }
  }
};
</script>

<style scoped>
#navigation .btn {
  border-radius: 50%;
}
</style>