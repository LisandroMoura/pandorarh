<template>
  <!-- Página de Lista de Colaboradores -->
  <div class="w-full px-2">
    <Breadcrumb titulo="Lista de funcionários cadastrados:" currentPage="list" />
    <div class="mx-auto p-4 bg-white rounded-lg shadow-md">

      <!-- Cabeçalho -->
      <div class="border-b pb-4 mb-6 ">
        <div>
          <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            Lista de Colaboradores</h2>
        </div>
        <p class="text-sm text-gray-500">Colaboradores cadastrados em nossa base de dados</p>
      </div>

      <!-- Itens -->
      <div class="grid grid-cols-1 gap-4">
        <ListItem />
        <ListItem />
        <ListItem />
        <ListItem />
        <ListItem />
      </div>
    </div>
  </div>
</template>

<script setup>
// TODO: requisitar os dados do backend
</script>

<style></style>