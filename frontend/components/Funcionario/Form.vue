<template>
  <div class="w-full px-2">
    <Breadcrumb titulo="Cadastrar novo Funcionário:" currentPage="form" />
    <div class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <form @submit.prevent="submitForm" class="space-y-6">
        <!--mensagens -->
        <Message />
        <!-- Cabeçalho -->
        <div class="border-b pb-4 mb-6 ">
          <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
              <div v-if="action === 'view'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
              </div>
              <div v-if="action === 'edit'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

              </div>
              {{ titulo }}
            </h2>
          </div>
          <p class="text-sm text-gray-500">{{ descricao }}</p>
        </div>

        <!-- ID -->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Colaborador</legend>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Código</label>
              <input type="text" v-model="form.id"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.id }" disabled>
              <p v-if="errors.id" class="text-red-500 text-xs mt-1">{{ errors.id }}</p>
            </div>
          </div>
        </fieldset>

        <!--Identificação-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Identificação</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nome -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">* Nome Completo</label>
              <input type="text" v-model="form.nome" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.nome }">
              <p v-if="errors.nome" class="text-red-500 text-xs mt-1">{{ errors.nome }}</p>
            </div>

            <!-- Apelido -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Apelido(opcional)</label>
              <input type="text" v-model="form.apelido" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
          </div>
        </fieldset>

        <!--informações de contato-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Informações de contato</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- email -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">*Email</label>
              <input type="email" v-model="form.email" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.email }">
              <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
            </div>

            <!-- Telefone -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Telefone(opcional)</label>
              <input type="text" v-model="form.telefone" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
          </div>
        </fieldset>

        <!--Documentos-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Documentos</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Cpf -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">* Cpf</label>
              <input type="text" v-model="form.cpf" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.cpf }">
              <p v-if="errors.cpf" class="text-red-500 text-xs mt-1">{{ errors.cpf }}</p>
            </div>
            <!-- RG -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Rg(opcional)</label>
              <input type="text" v-model="form.rg" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
          </div>
        </fieldset>

        <!--Filiação-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Filiação</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nome do Pai -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Nome do Pai(opcional)</label>
              <input type="text" v-model="form.nome_pai" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <!-- Nome da Mãe -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Nome da Mãe(opcional)</label>
              <input type="text" v-model="form.nome_mae" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
          </div>
        </fieldset>

        <!--Nascimento-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Nascimento</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Data de Nascimento -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">Data de Nascimento</label>
              <input type="date" v-model="form.data_nascimento" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.data_nascimento }">
              <p v-if="errors.data_nascimento" class="text-red-500 text-xs mt-1">{{ errors.data_nascimento }}</p>
            </div>
            <!-- Gênero -->
            <div>
              <label class="block text-sm font-medium text-gray-600 mb-1">Gênero(opcional)</label>
              <select v-model="form.genero" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <option value="Não informado" selected>Não informado</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
              </select>
            </div>
          </div>
        </fieldset>

        <!--Endereçamento-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Endereçamento</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Cep -->
            <div>
              <label class="block text-sm font-medium text-black-600 mb-1">Cep(opcional)</label>
              <input type="text" v-model="form.cep" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <!-- Endereço -->
            <div>
              <label class="block text-sm font-medium text-black-600 mb-1">Logadouro(opcional)</label>
              <input type="text" v-model="form.endereco" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
          </div>
        </fieldset>

        <!--Contratação-->
        <fieldset class="border p-4 rounded-lg">
          <legend class="text-sm font-medium text-black-600 px-2">Contratação</legend>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Cargo -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">*Cargo</label>
              <select v-model="form.cargo" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <option value="1" selected>Programador</option>
                <option value="2">Analista</option>
                <option value="3">Gerente de Vendas</option>
              </select>
            </div>
            <!-- Salário -->
            <div>
              <label class="block text-sm font-medium text-red-600 mb-1">*Salário</label>
              <input type="number" v-model="form.salario" :disabled="action === 'view'"
                class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500"
                :class="{ 'border-red-500': errors.salario }">
              <p v-if="errors.salario" class="text-red-500 text-xs mt-1">{{ errors.salario }}</p>
            </div>
          </div>
        </fieldset>

        <!-- CallActions -->
        <div class="flex justify-end gap-4 mt-8">

          <button v-if="action !== 'view'" type="button" @click="limpar"
            class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
            {{ props.action === 'cadastro' ? 'Limpar' : 'Restaurar' }}
          </button>

          <button type="button" @click="voltar"
            class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
            Cancelar
          </button>

          <button v-if="action !== 'view'" type="submit"
            class="px-6 py-2 bg-blue-600 hover:bg-red-700 text-white rounded-md transition-colors">
            {{ isLoading ? 'Carregando...' : 'Salvar' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
const { authFetch } = useFetchAuth()
const router = useRouter()
const isLoading = ref(false)
const errors = reactive({});

import { useNotify } from '~/composables/useNotify';
const { notify, successMessage, errorMessage } = useNotify();

const props = defineProps({
  titulo: { type: String, required: true },
  descricao: { type: String, required: true },
  action: { type: String, required: true }
})

// Definindo o estado reativo usando `reactive`
const form = reactive({
  id: '',
  nome: '',
  apelido: '',
  nome_pai: '',
  nome_mae: '',
  cpf: '',
  rg: '',
  data_nascimento: '',
  genero: 'Não informado',
  cep: '',
  endereco: '',
  cargo: 1,
  salario: 0,
  email: "",
  telefone: ""
});

const formBkp = ref({});

// Pega o ID da rota
const route = useRoute()
const id = ref(route.params.id) // Pega o ID da URL dinamicamente

// Função para submeter o formulário
function submitForm() {

  // Limpa os erros antes de validar novamente
  Object.keys(errors).forEach(key => delete errors[key]);

  if (!form.nome) {
    errors.nome = 'o nome é obrigatório';
  }

  if (!form.email) {
    errors.email = 'o Email é obrigatório';
  }

  if (!form.data_nascimento) {
    errors.data_nascimento = 'A data de nascimento é obrigatória';
  }

  if (!form.cpf) {
    errors.cpf = 'o CPF é obrigatório';
  }

  if (form.salario < 1518) {
    errors.salario = 'o Salário deve ser igual ou maior ao mínimo no Brsil: R$ 1.518.00';
  }

  // Verifica se não há erros antes de enviar o formulário
  if (Object.keys(errors).length === 0) {
    props.action === 'cadastro' ? create(form) : update(form)
  }
}

const voltar = () => {
  router.push('/funcionarios'); // Redireciona para a rota /funcinarios
};

// Função simples para limpar ou  restaurar os dados do formulário
const limpar = () => {
  // Lógica de cancelamento
  // TODO: tratar se form edição ou inclusão
  if (props.action === 'cadastro') {

    Object.assign(form, {
      id: '',
      nome: '',
      apelido: '',
      nome_pai: '',
      nome_mae: '',
      cpf: '',
      rg: '',
      data_nascimento: '',
      genero: 'Não informado',
      cep: '',
      endereco: '',
      cargo: 1,
      salario: 0.01,
      email: "",
      telefone: ""
    });
    notify('Formulário reiniciado!', 'success')
  }
  else {
    // restaurar os dados que vieram na requisição  
    Object.assign(form, formBkp.value);
    notify('Formulário restaurado!', 'success')
  }
}

// Método para buscar os dados do funcionário
const show = async (id) => {
  try {
    const response = await authFetch(`http://localhost:8000/api/funcionarios/${id}`, {
      method: 'GET'
    })

    // Atualizar o obj reativo form
    Object.assign(form, response.funcionario) // Preenche os campos do formulário
    form.data_nascimento = form.data_nascimento.split('T')[0]
    Object.assign(formBkp.value, form) // Preenche os campos do formulário

  } catch (error) {
    console.error('Erro na requisição:', error)
  }
}


import { useApiErrorHandler } from '~/composables/useApiErrorHandler';

const { handleError, errorsApi } = useApiErrorHandler();

const create = async (form) => {
  isLoading.value = true
  errorMessage.value = ''

  try {
    const response = await authFetch('http://localhost:8000/api/funcionarios/', {
      method: 'POST',
      body: JSON.stringify(form) // Envie os dados do formulário corretamente
    })

    if (response) {
      notify('Funcionário cadastrado com sucesso!', 'success', 2000)
      router.push({
        path: '/funcionarios',
      })
    }

  } catch (error) {

    if (error.data?.errors) {
      handleError(error, 'Erro ao cadastrar funcionário!');
    }
    // notify('Erro ao cadastrar! ' + message, 'error', 5000)

  } finally {
    isLoading.value = false
  }
}

const update = async (form) => {

  try {
    const response = await authFetch(`http://localhost:8000/api/funcionarios/${form.id}`, {
      method: 'PUT',
      body: JSON.stringify(form) // Envie os dados do formulário corretamente
    })

    if (response) {
      notify('Funcionário alterado com sucesso!', 'success', 2000)
      router.push({
        path: '/funcionarios',
      })
    }

  } catch (error) {

    if (error.data?.errors) {
      message += `\n\n`
      Object.entries(error.data.errors).forEach(([field, messages]) => {
        message += `${field}: ${messages.join(', ')}\n`
        errors[field] = messages
      })
      handleError(error, 'Erro ao cadastrar funcionário!');
    }
  }
}

onMounted(() => {
  if (props.action !== 'cadastro' && id.value) {
    show(id.value)
  }
})
</script>

<style lang="scss" scoped></style>