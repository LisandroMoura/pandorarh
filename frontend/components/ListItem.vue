<template>
  <div class="bg-white rounded-lg shadow-md p-4 mb-4">
    <div class="flex justify-between items-start">
      <div class="flex-1">
        <div class="text-sm text-gray-500">id: {{ id }}</div>
        <h3 class="text-lg font-semibold text-gray-800">{{ nome }}</h3>
        <p class="text-sm text-gray-600">Nascimento: {{ data_nascimento }}</p>
      </div>

      <div class="flex gap-2">
        <button @click="ver(id)"
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

defineProps({
  id: Number,
  nome: String,
  data_nascimento: String
}
);

const successMessage = useState('successMessage')


const ver = (id) => {
  useRouter().push('/funcionarios/' + id);
}

const edit = (id) => {
  useRouter().push('/funcionarios/edit/' + id);
}

import { useNuxtApp } from '#app'

const destroy = async (id) => {
  const router = useRouter()
  const { authFetch } = useFetchAuth()


  if (!confirm('Tem certeza que deseja excluir este item?')) {
    return
  }

  try {

    const response = await authFetch(`http://localhost:8000/api/funcionarios/${id}`, {
      method: 'DELETE',
    });

    successMessage.value = 'Funcionário deletado com sucesso!'

    refreshNuxtData('funcionarios') // Usando a mesma chave usada no useFetch

    // Redirecionando para a lista
    useRouter().push({
      path: '/funcionarios',
    })

  } catch (error) {
    // useNuxtApp().$toast.error('Erro ao excluir funcionário');
    console.error('Erro ao excluir funcionário:', error)
  }
}


</script>

<style></style>
