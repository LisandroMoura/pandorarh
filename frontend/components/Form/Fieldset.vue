<template>
  <div>
    <!-- Componente custom de formulário Fieldset -->
    <fieldset class="border p-4 rounded-lg">
      <legend class="text-sm font-medium text-black-600 px-2">{{ title }}</legend>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <slot />
      </div>
    </fieldset>
  </div>
</template>

<script lang="ts" setup>
// definição de props
defineProps({
  title: String,
})
</script>

<style></style>