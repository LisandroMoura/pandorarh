<template>
  <div>
    <!-- custom componente responsável pela visualização 
     das mensagens da aplicação -->
    <div v-if="showMessage">
      <div v-if="successMessage"
        class="mb-10 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ successMessage }}
      </div>
      <div v-if="errorMessage"
        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-lg whitespace-pre-line flex items-left gap-3">

        <div>
          <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-5 h-5 mt-0.5 text-red-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <div>{{ errorMessage }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
// showMessage useState de controle para visualização das mensagens
// PS: O controle do tempo de visualização do aviso (mensagens)
//     é realizado o composable/useNotify
const showMessage = useState('showMessage', () => false);
const successMessage = useState('successMessage', () => '');
const errorMessage = useState('errorMessage', () => '');
</script>

<style></style>