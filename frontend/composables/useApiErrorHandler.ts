export const useUseApiErrorHandler = () => {
  const { notify } = useNotify(); // importar a composable useNotify
  const errors = useState('errors', () => ({}));


  const handleError = (error: {}, defaultMessage = 'Erro ao processar a requisição!') => {

  }
  return { handleError }
}
