<template>
  <div class="row">
    <nav class="col-sm-3 col-4" id="nav">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#personal-information">Personal Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact-person">Contact Person</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#academic-qualification">Academic Qualifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#professional-certifications">Professional Certifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#skills">Skills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#professional-memberships">Professional Memberships</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#work-experience">Work Experience</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#referees">Referees</a>
        </li>
      </ul>
    </nav>

    <div id="spy" class="col-sm-9 col-8" data-spy="scroll" data-target="#nav" data-offset="1">
      <div class="shadow-sm p-3 m-2" id="personal-information">
        <personal-information />
      </div>
      <div class="shadow-sm p-3 m-2" id="contact-person">
        <contact-person />
      </div>
      <div class="shadow-sm p-3 m-2" id="academic-qualification">
        <academic-qualifications />
      </div>
      <div class="shadow-sm p-3 m-2" id="professional-certifications">
        <professional-certifications />
      </div>
      <div class="shadow-sm p-3 m-2" id="skills">
        <skills />
      </div>
      <div class="shadow-sm p-3 m-2" id="professional-memberships">
        <professional-memberships />
      </div>
      <div class="shadow-sm p-3 m-2" id="work-experience">
        <work-experience />
      </div>
      <div class="shadow-sm p-3 m-2" id="referees">
        <referees />
      </div>
    </div>
  </div>
<<<<<<< HEAD
</template>
<script>

const PersonalInformation = require("./PersonalInformation").default;
const ContactPerson = require("./ContactPerson").default;
const AcademicQualifications = require("./AcademicQualifications").default;
const ProfessionalCertifications = require("./ProfessionalCertifications")
  .default;
const Skills = require("./Skills").default;
const ProfessionalMemberships = require("./ProfessionalMemberships").default;
const WorkExperience = require("./WorkExperience").default;
const Referees = require("./Referees").default;

export default {
  name: "Profile",
  components: {
    PersonalInformation,
    ContactPerson,
    AcademicQualifications,
    ProfessionalCertifications,
    Skills,
    ProfessionalMemberships,
    WorkExperience,
    Referees
  }
};
</script>

<style scoped>
#spy {
  position: relative;
  height: 100vh;
  overflow-y: scroll;
}
</style>
=======
</div>

</body>
</html>

>>>>>>> b4db1ac300152416e73de761d1ae0b844e5820ad
