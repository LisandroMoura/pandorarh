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
import { ref, onMounted } from 'vue'
// TODO: requisitar os dados do backend

// const funcionarios = ref([])
// const loading = ref(true)
// const error = ref(null)

// const funcionarios = ref([
//   { id: 1, nome: "João da Silva", data_nascimento: "01/01/1990" },
//   { id: 2, nome: "Maria Oliveira", data_nascimento: "05/07/1985" },
//   { id: 3, nome: "Carlos Souza", data_nascimento: "20/11/1992" },
//   { id: 4, nome: "Carlos Souza", data_nascimento: "20/11/1992" },
//   { id: 5, nome: "Carlos Souza", data_nascimento: "20/11/1992" },
//   { id: 6, nome: "Carlos Souza", data_nascimento: "20/11/1992" },
// ])
// const fetchFuncionarios = async () => {
//   try {
//     const response = await fetch('http://localhost:8000/api/funcionarios') // Ajuste a URL conforme necessário
//     if (!response.ok) throw new Error('Erro ao carregar os funcionários')

//     const data = await response.json()
//     if (data.ok) {
//       funcionarios.value = data.funcionarios
//     } else {
//       throw new Error('Resposta inválida da API')
//     }

//   } catch (err) {
//     error.value = err.message
//   } finally {
//     loading.value = false
//   }
// }

// onMounted(fetchFuncionarios)

const { data: funcionarios, pending, error } = await useAsyncData('funcionarios', async () => {
  try {
    const response = await $fetch('http://localhost:8000/api/funcionarios', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    })

    // Processamento dos dados com tratamento de erros
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

    // Mostrar notificação global
    const { $toast } = useNuxtApp()
    $toast.error('Falha ao carregar funcionários')

    // Retornar array vazio para evitar erros no template
    return []
  }
})
</script>

<style></style>