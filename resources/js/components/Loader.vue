<template>
  <div class="spinner-border text-primary h4" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</template>

<script>
export default {
  name: "Loader",
};
</script>

<style lang="scss" scoped>
.spinner-border {
  height: 5rem;
  width: 5rem;
  position: absolute;
  top: 50%;
  left: 50%;
}
</style>