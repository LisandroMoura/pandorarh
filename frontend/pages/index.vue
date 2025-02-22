<template>
  <!-- Página de Lista de Colaboradores -->
  <div class="w-full px-2">
    <Breadcrumb currentPage="list" />

    <!-- componente custom para exibir mensagens -->
    <Message />
    
    <!-- componente custom para exibir barra de carregamento -->
    <LoadingBar />    

    <!-- verificação de dados exibir a tabela de funcionários -->
    <div v-if="funcionarios.length > 0" class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <!-- Cabeçalho -->
      <div class="border-b pb-4 mb-6 ">
        <div>
          <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            Lista de Colaboradores</h2>
        </div>
        <p class="text-sm text-gray-500">Colaboradores cadastrados em nossa base de dados</p>
      </div>
      <!-- Itens da lista -->
      <div class="grid grid-cols-1 gap-4">
          <ListItem v-for="funcionario in funcionarios" :key="funcionario.id" :id="funcionario.id"
          :nome="funcionario.nome" :data_nascimento="funcionario.data_nascimento" /> 
      </div>
    </div>
    <!-- mensagem de erro -->
    <div v-else class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <p class="text-center text-gray-500">Nenhum colaborador encontrado. {{refError}}</p>
      </div>
  </div>
</template>

<script setup>

// injeção do composable responsável por fazer as requsições autenticadas
const { authFetch } = useFetchAuth()

// importanto as variáveis de ambiente do config
const config = useRuntimeConfig();

// constante para controle de carregamento de erros de requisição
const refError = ref(null)

/**
 * Metodo assíncrono para obter a lista de colaboradores
 */
const { data: funcionarios } = await useAsyncData('funcionarios', async () => {
  // importanto as variáveis de ambiente do config
  
  try {
    const response = await authFetch(`${config.public.apiBaseUrl}/funcionarios/`, {
      method: 'GET'
    })

    // Aplicar a data no formato brasileiro padrão UTC
    // para apresentar a data de nascimento conforme o protótipo do Desafio 
    return response.funcionarios.map(item => {
      return {
        ...item,
        data_nascimento: new Intl.DateTimeFormat('pt-BR', { timeZone: 'UTC' }).format(new Date(item.data_nascimento))
      }
    })

  } catch (error) {

    // injeção do composable responsável por notificar as mensagens ao usuario
    const { notify } = useNotify(); 

    // Verifica se o erro é proveniente de uma falha de conexão com a API
    if (error.name === 'FetchError' || error.message.includes('Failed to fetch')) {
      refError.value = 'Serviço indisponível, verifique se o servidor está ativo.'
      notify(`Erro ao conectar com o servidor. Serviço pode estar indisponível. \n${error.message}`, 'error', 5000); 
    }
   
    // Retornar array vazio para evitar erros no template
    return []
  }
})
</script>

<style></style>