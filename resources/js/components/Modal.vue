<template>
  <div class="modal fade" ref="modal">
    <div class="modal-dialog" :class="[size ? `modal-${size}` : '']">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">
            <slot name="title"></slot>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body px-5">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <slot name="actions"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const $ = require("jquery");

export default {
  props: { size: String },
  mounted() {
    $(this.$refs.modal).on("hidden.bs.modal", () => this.$emit("close"));
  }
};
</script>

<style scoped>
</style>