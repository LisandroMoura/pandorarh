<template>
  <!--Componete responsável por exibir os itens da lista de funcionários-->
  <div class="bg-white rounded-lg shadow-md p-4 mb-4">
    <div class="flex justify-between items-start">
      <div class="flex-1">
        <div class="text-sm text-gray-500">id: {{ id }}</div>
        <h3 class="text-lg font-semibold text-gray-800">{{ nome }}</h3>
        <p class="text-sm text-gray-600">Nascimento: {{ data_nascimento }}</p>
      </div>

      <div class="flex gap-2">
        <button @click="show(id)"
          class="px-3 py-1 text-sm text-green-600 hover:text-green-900 border border-green-600 rounded-md transition-colors">
          Ver
        </button>
        <button @click="edit(id)"
          class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 border border-blue-500 rounded-md transition-colors">
          Editar
        </button>
        <button @click="destroy(id)"
          class="px-3 py-1 text-sm text-red-600 hover:text-red-800 border border-red-500 rounded-md transition-colors">
          Excluir
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>

// definição das Props
defineProps({
  id: Number,
  nome: String,
  data_nascimento: String
}
);

// injeção do composable responsável por notificar as mensagens ao usuario
import { useNotify } from '~/composables/useNotify';
const { notify } = useNotify();

// injeção do composable responsável por fazer as requsições autenticadas
const { authFetch } = useFetchAuth()

// injeção do composable responsável por tratar os erros da api
const { handleError } = useApiErrorHandler();

/**
 * Metodo responsável por chamar a roda de exibição 
 * dos detalhes do funcionário
 */
const show = (id) => {
  useRouter().push('/funcionarios/' + id);
}

/**
 * Metodo responsável por chamar a roda de edição 
 * do funcionário
 */
const edit = (id) => {
  useRouter().push('/funcionarios/edit/' + id);
}

/**
 * Metodo responsável por excluir o funcionário da base de dados
 */
const destroy = async (id) => {
  // confirmar com o usuário a exclusão do registro...
  if (!confirm('Tem certeza que deseja excluir este item?')) {
    return
  }

  try {

    // importanto as variáveis de ambiente do config
    const config = useRuntimeConfig();

    // chamar o endpoint de exclusão
    const response = await authFetch(`${config.public.apiBaseUrl}/funcionarios/${id}`, {
      method: 'DELETE',
    });

    // Notificando o usuário
    notify('Funcionário excluido com sucesso!', 'success', 2000)

    // atualisando o objeto reativo de funcionários
    refreshNuxtData('funcionarios')

    // Redirecionando para a lista
    useRouter().push({
      path: '/funcionarios',
    })

  } catch (error) {
    if (error.data?.errors) {
      handleError(error, 'Erro ao cadastrar funcionário!');
    }
  }
}


</script>

<style></style>
