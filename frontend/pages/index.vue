<template>
  <!-- HomePage -->
  <div class="w-full text-center pt-10 flex flex-col items-center justify-center bg-gray-50">
    <div class="w-full px-2 flex flex-col items-center">
      <div class="space-y-6 text-center">

        <!-- Botão Listar Funcionários -->
        <NuxtLink to="/funcionarios"
          class="block w-full max-w-xs bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
          Listar Funcionários
        </NuxtLink>

        <!-- Botão Cadastrar Funcionário -->
        <NuxtLink to="/funcionarios/cadastro"
          class="block w-full max-w-xs bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
          Cadastrar Funcionário
        </NuxtLink>
      </div>
    </div>

  </div>
</template>

<script setup>
</script>

<style>
/* Adicionar animação de scale nos botões de cadastro e de lista */
.hover\:scale-105:hover {
  transform: scale(1.05);
}
</style>