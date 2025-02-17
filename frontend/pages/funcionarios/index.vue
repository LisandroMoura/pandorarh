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
        <ListItem v-for="funcionario in funcionarios" :key="funcionario.id" :id="funcionario.id" :nome="funcionario.nome"
          :data_nascimento="funcionario.data_nascimento" />
      </div>
    </div>
  </div>
</template>

<script setup>
// TODO: requisitar os dados do backend
const funcionarios = ref([
  { id: 1, nome: "João da Silva", data_nascimento: "01/01/1990" },
  { id: 2, nome: "Maria Oliveira", data_nascimento: "05/07/1985" },
  { id: 3, nome: "Carlos Souza", data_nascimento: "20/11/1992" }
]);

</script>

<style></style>