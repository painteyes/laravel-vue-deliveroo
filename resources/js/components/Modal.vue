<template>
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Warning</h5>
        </div>
        <div class="modal-body">
          <p>{{ warning }}</p>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-warning"
            data-dismiss="modal"
            @click="$emit('close')"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Modal",
  props: ["warning"],
};
</script>