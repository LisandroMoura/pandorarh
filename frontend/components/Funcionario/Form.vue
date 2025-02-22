<template>
  <div class="w-full px-2">
    
    <!-- componente custom para exibir barra de carregamento -->
    <LoadingBar />

    <Breadcrumb titulo="Cadastrar novo Funcionário:" currentPage="form" />
    <Loading v-if="isLoading" />
    <div class="mx-auto p-4 bg-white rounded-lg shadow-md">
      <form @submit.prevent="submitForm" class="space-y-6">
        <!--mensagens -->
        <Message />
        <!-- Cabeçalho -->
        <div class="border-b pb-4 mb-6">
          <div>
            <h2
              class="text-2xl font-bold text-gray-800 flex items-center gap-2"
            >
              <div v-if="action === 'view'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                  />
                </svg>
              </div>
              <div v-if="action === 'edit'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                  />
                </svg>
              </div>
              {{ titulo }}
            </h2>
          </div>
          <p class="text-sm text-gray-500">{{ descricao }}</p>
        </div>

        <!-- Colaborador:id-->
        <FormFieldset title="Colaborador">
          <FormInput
            label="Código"
            type="text"
            v-model="form.id"
            :disabled="action === 'view'"
            :inputDisable="true"
          />
        </FormFieldset>

        <!--Identificação: Nome e Apelido-->
        <FormFieldset title="Identificação">
          <FormInput
            label="Nome completo"
            type="text"
            v-model="form.nome"
            v-model:inputErro="errors.nome"
            :inputDisable="action === 'view'"
            :required="true"
          />
          <FormInput
            label="Apelido"
            type="text"
            v-model="form.apelido"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--informações de contato: Email e Telefone-->
        <FormFieldset title="Informações de contato">
          <FormInput
            label="Email"
            type="email"
            v-model="form.email"
            v-model:inputErro="errors.email"
            :inputDisable="action === 'view'"
            :required="true"
          />
          <FormCustomInputFormat
            format="phone"
            label="Telefone"
            type="text"
            v-model="form.telefone"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--Documentos: Cpf e Rg-->
        <FormFieldset title="Documentos">
          <FormCustomInputFormat
            format="cpf"
            label="CPF"
            type="text"
            v-model="form.cpf"
            v-model:inputErro="errors.cpf"
            :inputDisable="action === 'view'"
            :required="true"
          />
          <FormCustomInputFormat
            format="rg"
            label="RG"
            type="text"
            v-model="form.rg"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--Filiação: Nome do Pai e Nome da mãe-->
        <FormFieldset title="Filiação">
          <FormInput
            label="Nome do Pai(opcional)"
            type="text"
            v-model="form.nome_pai"
            :inputDisable="action === 'view'"
          />
          <FormInput
            label="Nome da Mãe(opcional)"
            type="text"
            v-model="form.nome_mae"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--Nascimento: Data de Nascimento e Gênero-->
        <FormFieldset title="Nascimento">
          <FormInput
            label="Data de Nascimento"
            type="date"
            v-model="form.data_nascimento"
            :required="true"
            v-model:inputErro="errors.data_nascimento"
            :inputDisable="action === 'view'"
          />
          <FormSelect
            label="Gênero(opcional)"
            type="text"
            v-model="form.genero"
            :options="opcoesGenero"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--Endereçamento: Cep e Endereço-->
        <FormFieldset title="Endereçamento">
          <FormInput
            label="Cep(opcional)"
            type="text"
            v-model="form.cep"
            :inputDisable="action === 'view'"
          />
          <FormInput
            label="Logadouro(opcional)"
            type="text"
            v-model="form.endereco"
            :inputDisable="action === 'view'"
          />
        </FormFieldset>

        <!--Contratação Cargo e Salário-->

        <FormFieldset title="Endereçamento">
          <FormSelect
            label="Cargo"
            type="text"
            v-model="form.cargo_id"
            :options="opcoesCargo"
            :required="true"
            :inputDisable="action === 'view'"
          />
          <FormCustomInputFormat
            format="currency"
            label="Salário"
            v-model="form.salario"
            :inputDisable="action === 'view'"
            :required="true"
            v-model:inputErro="errors.salario"
          />
        </FormFieldset>

        <!-- CallActions -->
        <div class="flex justify-end gap-4 mt-8">
          <button
            v-if="action !== 'view'"
            type="button"
            @click="limpar"
            class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
          >
            {{ props.action === "create" ? "Limpar" : "Restaurar" }}
          </button>

          <button
            type="button"
            @click="cancelar"
            class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
          >
            {{ props.action === "view" ? "Voltar" : "Cancelar" }}
          </button>

          <button
            v-if="action !== 'view'"
            type="submit"
            class="px-6 py-2 bg-[#18de99] hover:bg-[#21223a] hover:text-white text-[#21223a] rounded-md transition-colors"
          >
            {{ isLoading ? "Carregando..." : "Salvar" }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
// importações
import { ref, reactive, onMounted } from "vue";

// definição das Props
const props = defineProps({
  titulo: { type: String, required: true },
  descricao: { type: String, required: true },
  action: { type: String, required: true },
});

// injeção do composable responsável por fazer as requsições autenticadas
const { authFetch } = useFetchAuth();

// injeção do composable responsável por notificar as mensagens ao usuario
// import { useNotify } from '~/composables/useNotify';
const { notify, errorMessage } = useNotify();

// injeção do composable responsável por tratar os erros da api
const { handleError } = useApiErrorHandler();

// importanto as variáveis de ambiente do config
const config = useRuntimeConfig();

// constante para controle de carregamento
const isLoading = ref(false);

// Objeto reativo para armazenar os erros
const errors = reactive({});

// opções default para select de cargo
const opcoesCargo = [
  { label: "Desenvolvedor PHP", value: "1", default: true },
  { label: "Front-end", value: "2" },
  { label: "Designer", value: "3" },
  { label: "Gerente de Projetos", value: "4" },
];

// opções defauto para select de gênero
const opcoesGenero = [
  { label: "Não informado", value: "Não informado" },
  { label: "Masculino", value: "Masculino" },
  { label: "Feminino", value: "Feminino" },
];

// Objeto reativo para armazenar os dados do formulário
const form = reactive({
  id: "",
  nome: "",
  apelido: "",
  nome_pai: "",
  nome_mae: "",
  cpf: "",
  rg: "",
  data_nascimento: "",
  genero: "Não informado",
  cep: "",
  endereco: "",
  cargo_id: 1,
  salario: 0,
  email: "",
  telefone: "",
});

// Objeto reativo para armazenar os dados do formulário em caso de Alteração
// o objetivo é restaurar os dados do formulário caso o usuário cancele a edição
const formBkp = ref({});

// Pegar o ID da rota
const id = ref(useRoute().params.id);

/**
 * Metodo responsável por submeter o formulário
 */
const submitForm = () => {
  // validar o formulário
  if (validateForm()) {
    props.action === "create" ? create(form) : update(form);
  }
};

/**
 * Metodo responsável por validar o formulário, executando validações simples
 * no lado do cliente
 */
const validateForm = () => {
  // Limpa os erros antes de validar novamente
  Object.keys(errors).forEach((key) => delete errors[key]);

  console.log("validate", form.salario);

  if (!form.nome) {
    errors.nome = "o nome é obrigatório";
  }

  if (!form.email) {
    errors.email = "o Email é obrigatório";
  }

  if (!form.data_nascimento) {
    errors.data_nascimento = "A data de nascimento é obrigatória";
  }

  if (!form.cpf) {
    errors.cpf = "o CPF é obrigatório";
  }

  // exemplo de customização de validação
  if (form.salario < 1518) {
    errors.salario =
      "o Salário deve ser igual ou maior ao mínimo no Brasil: R$ 1.518.00";
  }

  return Object.keys(errors).length === 0;
};

/**
 * Metodo responsável por cancelar a ação atual do formulário e
 * voltar para a rota de lista de funcionários
 */
const cancelar = () => {
  useRouter().push("/"); // Redireciona para a rota /funcinarios
};

// Função simples para limpar ou restaurar os dados do formulário
const limpar = () => {
  // Caso seja uma nova inclusão, limpar o formulário
  if (props.action === "create") {
    Object.assign(form, {
      id: "",
      nome: "",
      apelido: "",
      nome_pai: "",
      nome_mae: "",
      cpf: "",
      rg: "",
      data_nascimento: "",
      genero: "Não informado",
      cep: "",
      endereco: "",
      cargo_id: 1,
      salario: 0.01,
      email: "",
      telefone: "",
    });
    notify("Formulário reiniciado!", "success");
  } else {
    // restaurar os dados que vieram na requisição
    Object.assign(form, formBkp.value);
    notify("Formulário restaurado!", "success");
  }
};

/**
 * Metodo responsável por buscar a lista de funcionários
 * e exibir na tela
 */
const show = async (id) => {
  try {
    const response = await authFetch(
      `${config.public.apiBaseUrl}/funcionarios/${id}`,
      {
        method: "GET",
      }
    );

    // Atualizar o obejeto reativo principal do formulário
    Object.assign(form, response.funcionario);

    // Tratamento para data de nascimento (remover a formatação de timestamp)
    form.data_nascimento = form.data_nascimento.split("T")[0];

    // Gerar um backup dos dados do formulário, caso o metodo limpar seja chamado
    Object.assign(formBkp.value, form); // Preenche os campos do formulário
  } catch (error) {
    console.error("Erro na requisição:", error);
  }
};

/**
 * Metodo responsável por incluir um novo funcionário
 */
const create = async (form) => {
  // definindo o estado de carregamento
  isLoading.value = true;
  errorMessage.value = "";

  try {
    // chama o endpoint de inclusão usando o composable de requisições autenticadas
    const response = await authFetch(
      `${config.public.apiBaseUrl}/funcionarios/`,
      {
        method: "POST",
        body: JSON.stringify(form),
      }
    );

    // definindo o estado de carregamento
    isLoading.value = false;

    // verifica se a resposta da requisição foi bem sucedida
    if (response) {
      // notificando o usuário
      notify("Funcionário cadastrado com sucesso!", "success", 5000);

      // redirecionando para a rota de listagem
      useRouter().push({
        path: "/",
      });
    }
  } catch (error) {
    if (error.data?.errors) {
      // usando o composable de tratamento de erros
      handleError(error, "Erro ao cadastrar funcionário!", errors);
    }
  }
};

/**
 * Metodo responsável por editar funcionário
 */
const update = async (form) => {
  // definindo o estado de carregamento
  isLoading.value = true;
  errorMessage.value = "";

  try {
    // chama o endpoint de edição usando o composable de requisições autenticadas
    const response = await authFetch(
      `${config.public.apiBaseUrl}/funcionarios/${form.id}`,
      {
        method: "PUT",
        body: JSON.stringify(form),
      }
    );

    // definindo o estado de carregamento
    isLoading.value = false;

    // verifica se a resposta da requisição foi bem sucedida
    if (response) {
      // notificando o usuário
      notify("Funcionário alterado com sucesso!", "success", 5000);
      useRouter().push({
        path: "/",
      });
    }
  } catch (error) {
    if (error.data?.errors) {
      // usando o composable de tratamento de erros
      handleError(error, "Erro ao alterar funcionário!", errors);
    }
  }
};
// Executa o método show caso a action do formulário seja diferente de cadastro
// Ou seja, caso a action do formulário seja de edição ou visualização será feita a
// requisição para buscar os dados do funcionário
onMounted(() => {
  if (props.action !== "create" && id.value) {
    show(id.value);
  }
});
</script>

<style lang="scss" scoped></style>
