<template>
  <div>
    <!--componente custom para exibir os links de navegação: Listar e Novo-->
    <div
      class="w-full flex flex-col md:flex-row justify-between items-start md:items-center px-4 md:px-8 gap-4 pt-4 mb-10">
      <h1 class="text-3xl font-bold text-gray-800 w-full md:w-auto">Funcionários da PandoraRH</h1>

      <nav class="flex gap-4 justify-start md:justify-center w-full md:w-auto">
        <a href="#" @click.prevent="navegarParaLista"
          class="flex items-center gap-2 text-gray-900 hover:text-gray-600 px-4 py-2 transition-colors"
          :class="{ 'border-b-2 border-red-500 font-bold text-black': currentPage === 'list' }">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
          </svg>
          Listar
        </a>
        <a href="#" @click.prevent="navegarParaCadastro"
          class="flex items-center gap-2 text-gray-900 hover:text-gray-600 px-4 py-2 transition-colors"
          :class="{ 'border-b-2 border-red-500 font-bold text-black': currentPage === 'form' }">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg> Novo
        </a>
      </nav>
    </div>
  </div>
</template>

<script setup>

// definição das Props
defineProps({
  currentPage: String,
})

// chamar a rota de lista
const navegarParaLista = () => {
  useRouter().push("/funcionarios");
}

// chamar a rota de cadastro
const navegarParaCadastro = () => {
  useRouter().push("/funcionarios/cadastro");
};


</script>

<style></style>