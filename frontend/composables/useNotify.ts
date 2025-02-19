
/**
 * Hook para controlar as exibições de mensagens na tela
 */
export const useNotify = () => {

  const showMessage = useState('showMessage', () => false);
  const successMessage = useState('successMessage', () => '');
  const errorMessage = useState('errorMessage', () => '');

  /**
   * Metodo responsavel notificar o usuário com as mesagens de sucesso ou erro
   */
  const notify = (message: string, type = "success", duration = 5000) => {
    showMessage.value = true;
    if (type === "success") {
      successMessage.value = message;
      errorMessage.value = "";
    } else {
      successMessage.value = "";
      errorMessage.value = message;
    }
    // Fazer o scroll da página para o topo, garantindo assim que o 
    // usuário veja a mensagem 
    window.scrollTo({ top: 0, behavior: "smooth" });

    // Esconde a mensagem após tempo determinado (default: 5 segundos)
    setTimeout(() => {
      showMessage.value = false;
      successMessage.value = "";
      errorMessage.value = "";
    }, duration);
  };

  return { notify, showMessage, successMessage, errorMessage };
}
