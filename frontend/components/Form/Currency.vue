<template>
    <div>
        <!-- Rótulo -->
        <label class="block text-sm font-medium text-gray-600 mb-1">
            <span v-if="required" class="text-red-600">*</span>
            {{ label }}
        </label>

        <!-- Campo de entrada -->
        <input type="text" :value="formattedValue" @input="handleInput" @blur="formatOnBlur" :disabled="inputDisable"
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

// Formata o valor ao exibir
const formattedValue = computed(() => {
    return props.modelValue !== null
        ? new Intl.NumberFormat("pt-BR", { minimumFractionDigits: 2 }).format(props.modelValue)
        : "";
});


// Função chamada quando o usuário digita no campo
const handleInput = (event: Event) => {
    const target = event.target as HTMLInputElement;

    let rawValue = target.value.replace(/\D/g, ""); // Remove tudo que não for número
    if (rawValue) {
        let numericValue = parseFloat(rawValue) / 100; // Ajusta para casas decimais
        emit("update:modelValue", numericValue);
    } else {
        emit("update:modelValue", null);
    }

    // Formata quando perde o foco
    const formatOnBlur = () => {
        if (props.modelValue !== null) {
            emit("update:modelValue", parseFloat(props.modelValue.toFixed(2)));
        }
    };

    // emit("update:modelValue", target.value);

    // Resetando o erro ao digitar
    if (localErro.value) {
        localErro.value = "";
        emit("update:inputErro", "");
    }
};
</script>
