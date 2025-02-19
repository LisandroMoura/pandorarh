import { useNotify } from '~/composables/useNotify';

interface ApiError {
  statusCode?: number;
  data?: {
    errors?: Record<string, string[]>;
    message?: string;
  };
  message?: string;
}

/**
 * Hook para tratamento de mensagens erros da API
 */
export const useApiErrorHandler = () => {
  const { notify } = useNotify();
  const errorsApi = useState<Record<string, string[]>>('errors', () => ({}));

  const handleError = (error: ApiError, defaultMessage: string = 'Erro ao processar a requisição!', errors: Record<string, string[]> = {}) => {
    let message = error.data?.message || error.message || defaultMessage;

    // Zerar os erros anteriores
    errorsApi.value = {};

    // Obter os erros da requsição.
    if (error.data?.errors) {
      // Adicionar quebra de linha para melhor leitura do usuário em tela
      message += `\n\n`;

      // concatenar os erros
      Object.entries(error.data.errors).forEach(([field, messages]) => {
        message += `${field}: ${messages.join(', ')}\n`;
        errorsApi.value[field] = messages;
        // adcionar os erros da requisição aos elementos (inputs) do formulário/validação
        errors[field] = messages;
      });
    }

    // chamar o composable de notificação
    notify(`${defaultMessage}\n${message}`, 'error', 5000);

    return errorsApi.value;
  };

  return { handleError, errorsApi };
};
