<template>
  <div class="w-full h-full">
    <!--Página inicial da aplicação: Header-->
    <header class="w-full h-20 border-b border-gray-200 flex items-center gap-4 pl-8">
      <NuxtLink to="/">
        <img src="~/assets/logo.png" alt="Logo" class="w-12 h-12" />
      </NuxtLink>
      <NuxtLink to="/">
        <p class="text-3xl font-bold text-[#21223a]">Pandora RH</p>
      </NuxtLink>
    </header>
    <main class="w-full h-full pt-4 px-8">
      <NuxtPage />
    </main>
  </div>
</template>

<script setup>
</script>