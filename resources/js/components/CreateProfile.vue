<template>
  <div class="container">
    <div id="navigation" class="d-flex justify-content-center my-4">
      <router-link
        v-for="(name, idx) in urlNames"
        :key="idx"
        :to="{name}"
        class="btn shadow mx-2 rounded-circle"
        :class="[idx === currentIdx ? 'btn-success' : 'btn-secondary']"
        @click.native="currentIdx = idx"
      >{{idx + 1}}</router-link>
    </div>
    <router-view />
    <div class="d-flex flex-row-reverse">
      <router-link
        class="btn btn-success"
        :to="nextUrl"
        @click.native="currentIdx++"
      >{{fowardBtnLabel}}</router-link>
    </div>
  </div>
</template>

<script>
const { mapGetters } = require("vuex");

export default {
  name: "CreateProfile",
  data() {
    return {
      urlNames: [
        "add-personal-information",
        "add-contact-person",
        "add-academic-qualifications",
        "add-work-experience",
        "add-professional-certifications",
        "add-professional-memberships",
        "add-skills",
        "add-referees"
      ],
      currentIdx: 0,
      fowardBtnLabel: "Next"
    };
  },
  watch: {
    currentIdx(value) {
      const lastIdx = this.urlNames.length - 1;
      if (value > lastIdx) {
        this.$router.push({
          name: "profile",
          params: { username: this.session.user.username }
        });
      } else {
        this.fowardBtnLabel = value === lastIdx ? "Finish" : "Next";
      }
    }
  },
  computed: {
    ...mapGetters(["session"]),
    nextUrl() {
      return { name: this.urlNames[this.currentIdx + 1] };
    }
  },
  beforeRouteEnter(to, from, next) {
    const match = to.matched.find(record => record.meta.index);
    next(vm => {
      vm.currentIdx = match ? match.meta.index : 0;
    });
  }
};
</script>

<style scoped>
</style>