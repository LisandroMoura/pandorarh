<template>
  <div>
    <!-- Rótulo -->
    <label class="block text-sm font-medium text-gray-600 mb-1" :class="{ 'text-red-600': required }">
      {{ label }}
    </label>

    <!-- Campo de entrada -->
    <input :type="type" :value="modelValue" @input="handleInput" :disabled="inputDisable"
      class="w-full px-3 py-2 border rounded-md focus:border-red-500"
      :class="{ 'border-red-500': localErro, [inputCustomClass]: inputCustomClass }">

    <!-- Mensagem de erro -->
    <p v-if="localErro" class="text-red-500 text-xs mt-1">{{ localErro }}</p>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

// Definição de props
const props = defineProps<{
  label: string;
  type: string;
  required: boolean;
  modelValue: string;
  inputErro?: string;
  inputDisable?: boolean;
  inputCustomClass?: string;
}>();

const emit = defineEmits(["update:modelValue", "update:inputErro"]);

// Criando um estado local para o erro, para garantir reatividade
const localErro = ref(props.inputErro || "");

// Assistindo mudanças na prop inputErro para manter sincronização
watch(() => props.inputErro, (newErro) => {
  localErro.value = newErro || "";
});

// Função chamada quando o usuário digita no campo
const handleInput = (event: Event) => {
  const target = event.target as HTMLInputElement;
  emit("update:modelValue", target.value);

  // Resetando o erro ao digitar
  if (localErro.value) {
    localErro.value = "";
    emit("update:inputErro", "");
  }
};
</script>
