<template>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1" :class="[required ? 'text-red-600' : '']">{{ label
            }}</label>

        <select :value="modelValue" :disabled="inputDisable" @input="$emit('update:modelValue', $event.target.value)"
            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
            :class="[inputErro ? 'border-red-500' : '', inputCustomClass]">
            <option v-for="option in options" :key="option.value" :value="option.value">
                {{ option.label }}
            </option>
        </select>
        <p v-if="inputErro" class="text-red-500 text-xs mt-1">{{ inputErro }}</p>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    label: string;
    type: string;
    options: { label: string; value: string, selected?: boolean }[];
    required: boolean;
    modelValue: string;
    inputErro?: string;
    inputDisable?: boolean;
    inputCustomClass?: string;
}>();

defineEmits(["update:modelValue"]);
</script>
<style></style>