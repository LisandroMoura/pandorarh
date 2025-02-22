<template>
  <div>
    <div v-if="displayLoadingBar" class="loading-bar" :class="{ 'loading-bar--complete': isComplete }"></div>
  </div>
</template>

<script setup>
const displayLoadingBar = ref(true);
const isComplete = ref(false);

  onMounted(() => {
    displayLoadingBar.value = true;
    setTimeout(() => {
      isComplete.value = true;
      // displayLoadingBar.value = false;
    }, 100);
    setTimeout(() => {
      isComplete.value = false;
      displayLoadingBar.value = false;
    }, 1200);
  })

</script>

<style scoped>
.loading-bar {
  position: fixed;
  top: 0;
  left: 0;
  width: 0;
  height: 3px;
  background-color: #4f46e5; /* Cor da barra de loading */
  z-index: 1000;
  transition: width 0.5s linear;
}

.loading-bar--complete {
  width: 100%;
}
</style>