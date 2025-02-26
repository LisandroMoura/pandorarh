<template>
  <div class="w-full px-2">
    <Breadcrumb currentPage="list" />

    <Message />
    <LoadingBar />

    <!-- Exibir loading até os dados estarem carregados -->
    <div v-if="isLoading" class="text-center">Carregando dados...</div>

    <!-- Exibir tabela de colaboradores somente se dados estiverem carregados -->
    <div v-if="!isLoading && funcionarios && funcionarios.length > 0" class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <div class="border-b pb-4 mb-6 ">
        <div>
          <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            Lista de Colaboradores</h2>
        </div>
        <p class="text-sm text-gray-500">Colaboradores cadastrados em nossa base de dados</p>
      </div>

      <div class="grid grid-cols-1 gap-4">
        <ListItem v-for="funcionario in funcionarios" :key="funcionario.id" :id="funcionario.id" :nome="funcionario.nome" :data_nascimento="funcionario.data_nascimento" />
      </div>
    </div>

    <div v-else class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <p class="text-center text-gray-500">Nenhum colaborador encontrado. {{ refError }}</p>
    </div>
  </div>
</template>

<script setup>
const { authFetch } = useFetchAuth()
const config = useRuntimeConfig();
const refError = ref(null)
const isLoading = ref(true)
const funcionarios = ref([])

const fetchFuncionarios = async () => {
  try {
    const response = await authFetch(`${config.public.apiBaseUrl}/funcionarios/`, {
      method: 'GET'
    })
    funcionarios.value = response.funcionarios.map(item => ({
      ...item,
      data_nascimento: new Intl.DateTimeFormat('pt-BR', { timeZone: 'UTC' }).format(new Date(item.data_nascimento))
    }))
  } catch (error) {
    const { notify } = useNotify(); 
    if (error.name === 'FetchError' || error.message.includes('Failed to fetch')) {
      refError.value = 'Serviço indisponível, verifique se o servidor está ativo.'
      notify(`Erro ao conectar com o servidor. Serviço pode estar indisponível. \n${error.message}`, 'error', 5000); 
    }
    funcionarios.value = []
  } finally {
    isLoading.value = false
  }
}

// Chama o método ao montar a página
onMounted(fetchFuncionarios)
</script>
