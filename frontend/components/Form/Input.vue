<template>
  <div>
    <!-- Componente custom de formulário Input -->
    <label class="block text-sm font-medium text-gray-600 mb-1" :class="[required ? 'text-red-600' : '']">{{ label
      }}</label>
    <input :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
      :disabled="inputDisable" class="w-full px-3 py-2 border rounded-md focus:border-red-500"
      :class="[inputErro ? 'border-red-500' : '', inputCustomClass]">
    <p v-if="inputErro" class="text-red-500 text-xs mt-1">{{ inputErro }}</p>
  </div>
</template>

<script setup lang="ts">
// definição de props
defineProps<{
  label: string;
  type: string;
  required: boolean;
  modelValue: string;
  inputErro?: string;
  inputDisable?: boolean;
  inputCustomClass?: string;
}>();
defineEmits(["update:modelValue"]);
</script>
<style></style>