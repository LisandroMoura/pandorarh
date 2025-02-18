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
        <ListItem v-for="funcionario in funcionarios" :key="funcionario.id" :id="funcionario.id"
          :nome="funcionario.nome" :data_nascimento="funcionario.data_nascimento" />
      </div>
    </div>
  </div>
</template>

<script setup>

const { authFetch } = useFetchAuth()

const { data: funcionarios } = await useAsyncData('funcionarios', async () => {

  try {
    const response = await authFetch('http://localhost:8000/api/funcionarios', {
      method: 'GET'
    })

    // Aplicar o tratamento de valor do tipo date
    // para apresentar a data de nascimento conforme 
    // o protótipo do Desafio 
    return response.funcionarios.map(item => {
      return {
        ...item,
        data_nascimento: new Date(item.data_nascimento).toLocaleDateString('pt-BR')
      }
    })

  } catch (error) {
    console.error('Erro na requisição:', error)

    // Opcional: Tratamento personalizado para diferentes códigos de status
    if (error.statusCode === 404) {
      throw createError({ statusCode: 404, statusMessage: 'Endpoint não encontrado' })
    }

    // Retornar array vazio para evitar erros no template
    return []
  }
})
</script>

<style></style>