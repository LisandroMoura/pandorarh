export const useNotify = () => {
  const showMessage = useState('showMessage', () => false);
  const successMessage = useState('successMessage', () => '');
  const errorMessage = useState('errorMessage', () => '');

  const notify = (message: string, type = "success", duration = 5000) => {
    showMessage.value = true;
    if (type === "success") {
      successMessage.value = message;
      errorMessage.value = "";
    } else {
      successMessage.value = "";
      errorMessage.value = message;
    }
    window.scrollTo({ top: 0, behavior: "smooth" });

    // Esconde a mensagem após 5 segundos
    setTimeout(() => {
      showMessage.value = false;
      successMessage.value = "";
      errorMessage.value = "";
    }, duration);
  };

  return { notify, showMessage, successMessage, errorMessage };
}
