<template>
  <div class="bg-white rounded-lg shadow-md p-4 mb-4">
    <div class="flex justify-between items-start">
      <div class="flex-1">
        <div class="text-sm text-gray-500">id: {{ id }}</div>
        <h3 class="text-lg font-semibold text-gray-800">{{ nome }}</h3>
        <p class="text-sm text-gray-600">Nascimento: {{ data_nascimento }}</p>
      </div>

      <div class="flex gap-2">
        <button
          class="px-3 py-1 text-sm text-green-600 hover:text-green-900 border border-green-600 rounded-md transition-colors">
          Ver
        </button>
        <button
          class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 border border-blue-500 rounded-md transition-colors">
          Editar
        </button>
        <button
          class="px-3 py-1 text-sm text-red-600 hover:text-red-800 border border-red-500 rounded-md transition-colors">
          Excluir
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
defineProps({
  id: Number,
  nome: String,
  data_nascimento: String
}
);
</script>

<style></style>