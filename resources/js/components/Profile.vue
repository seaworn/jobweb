<template>
  <div class="container">
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
          <personal-information></personal-information>
        </div>
        <div class="shadow-sm p-3 m-2" id="contact-person">
          <contact-person></contact-person>
        </div>
        <div class="shadow-sm p-3 m-2" id="academic-qualification">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Academic Qualifications</h4>
            <router-link :to="{name: 'add-academic-qualifications'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <academic-qualifications :show-actions="false"></academic-qualifications>
        </div>
        <div class="shadow-sm p-3 m-2" id="professional-certifications">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Professional Certifications</h4>
            <router-link :to="{name: 'add-professional-certifications'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <professional-certifications :show-actions="false"></professional-certifications>
        </div>
        <div class="shadow-sm p-3 m-2" id="skills">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Skills</h4>
            <router-link :to="{name: 'add-skills'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <skills></skills>
        </div>
        <div class="shadow-sm p-3 m-2" id="professional-memberships">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Professional Memberships</h4>
            <router-link :to="{name: 'add-professional-memberships'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <professional-memberships :show-actions="false"></professional-memberships>
        </div>
        <div class="shadow-sm p-3 m-2" id="work-experience">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Work Experience</h4>
            <router-link :to="{name: 'add-work-experience'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <work-experience :show-actions="false"></work-experience>
        </div>
        <div class="shadow-sm p-3 m-2" id="referees">
          <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold">Referees</h4>
            <router-link :to="{name: 'add-referees'}" class="btn btn-primary">
              <i class="fa fa-edit" />&nbsp;Update
            </router-link>
          </div>
          <referees :show-actions="false"></referees>
        </div>
      </div>
    </div>
  </div>
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
