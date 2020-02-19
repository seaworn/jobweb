const { ValidationOptionsMixin } = require('./mixins');

export const RequiredError = {
  name: 'RequiredError',
  mixins: [ValidationOptionsMixin],
  template: `<span v-show="!field.required && field.$dirty">This field is required.</span>`
}

export const AlphaError = {
  name: 'AlphaError',
  mixins: [ValidationOptionsMixin],
  template: `<span v-show="!field.alpha">Only letters allowed.</span>`
}

export const MinlengthError = {
  name: 'MinlengthError',
  mixins: [ValidationOptionsMixin],
  template: `<span v-show="!field.minLength">Must be atleast {{field.$params.minLength.min}} characters.</span>`
}

export const MaxlengthError = {
  name: 'MaxlengthError',
  mixins: [ValidationOptionsMixin],
  template: `<span v-show="!field.maxLength">Must be no more than {{field.$params.maxLength.max}} characters.</span>`
}

export const AlphanumError = {
  name: 'AlphanumError',
  mixins: [ValidationOptionsMixin],
  template: `<span v-show="!field.alphaNum">Only letters and numbers allowed.</span>`
}

export const EmailError = {
  name: 'EmailError',
  mixins: [ValidationOptionsMixin],
  components: { RequiredError },
  template: `
    <div class="invalid-feedback">
      <required-error v-bind="$props"/>
      <span v-show="!field.email">Enter a valid email.</span>
    </div>
  `
}

export const PhoneNoError = {
  name: 'PhoneNoError',
  mixins: [ValidationOptionsMixin],
  components: {RequiredError},
  template: `
    <div class="invalid-feedback">
      <required-error v-bind="$props"/>
      <span v-show="field.required && (!field.minLength || !field.maxLength)">Enter a valid phone number.</span>
    </div>
  `
}

export const NameError = {
  name: 'NameError',
  components: { RequiredError, AlphaError, MinlengthError },
  template: `
    <div class="invalid-feedback">
      <required-error v-bind="$attrs"/>
      <alpha-error v-bind="$attrs"/>
      <minlength-error v-bind="$attrs"/>
    </div>
  `
}
