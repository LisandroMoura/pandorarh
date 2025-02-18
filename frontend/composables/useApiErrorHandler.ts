import { useNotify } from '~/composables/useNotify';

interface ApiError {
  statusCode?: number;
  data?: {
    errors?: Record<string, string[]>;
    message?: string;
  };
  message?: string;
}

export const useApiErrorHandler = () => {
  const { notify } = useNotify();
  const errorsApi = useState<Record<string, string[]>>('errors', () => ({}));

  const handleError = (error: ApiError, defaultMessage: string = 'Erro ao processar a requisição!') => {
    let message = error.data?.message || error.message || defaultMessage;

    errorsApi.value = {}; // Limpa erros anteriores

    if (error.data?.errors) {
      message += `\n\n`;

      Object.entries(error.data.errors).forEach(([field, messages]) => {
        message += `${field}: ${messages.join(', ')}\n`;
        errorsApi.value[field] = messages;
      });
    }

    notify(`${defaultMessage}\n${message}`, 'error', 5000);
    return errorsApi.value;
  };

  return { handleError, errorsApi };
};
