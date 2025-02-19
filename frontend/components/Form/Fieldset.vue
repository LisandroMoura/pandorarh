<template>
  <div>
    <fieldset class="border p-4 rounded-lg">
      <legend class="text-sm font-medium text-black-600 px-2">{{ title }}</legend>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <slot />
      </div>
    </fieldset>
  </div>
</template>

<script lang="ts" setup>

defineProps({
  // form: {
  //   type: Object,
  //   required: true
  // },
  field: String,
  errorsField: String,
  // errors: {
  //   type: Object,
  //   required: true
  // },
  type: String,
  title: String,
  label: String
})


</script>

<style></style>