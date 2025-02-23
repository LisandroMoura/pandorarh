<!-- components/HelloWorld.vue -->
<template>
  <div class="hello-world">
    <h1>{{ msg }}</h1>
    
    <p class="description">
      Componente de exemplo para testes unitários no Nuxt.js
    </p>

    <button 
      @click="$emit('greet', 'Hello from Nuxt!')"
      class="greet-button"
    >
      Clique para saudar
    </button>
  </div>
</template>

<script setup>
defineProps({
  msg: {
    type: String,
    required: true
  }
});
</script>

<style scoped>
.hello-world {
  text-align: center;
  padding: 2rem;
  border: 1px solid #eaeaea;
  border-radius: 8px;
  max-width: 600px;
  margin: 0 auto;
}

h1 {
  color: #213547;
  font-size: 2em;
  margin-bottom: 1rem;
}

.description {
  color: #666;
  margin-bottom: 1.5rem;
}

.greet-button {
  background-color: #f5f5f5;
  border: 1px solid #ddd;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.25s;
}

.greet-button:hover {
  background-color: #e0e0e0;
}
</style>