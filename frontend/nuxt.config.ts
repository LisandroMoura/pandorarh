// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@nuxtjs/tailwindcss'
  ],
  runtimeConfig: {
    public: {
      apiBaseUrl: process.env.NUXT_API_BASE_URL || 'http://localhost:8000/api',
      apiUser: process.env.NUXT_API_USER || 'desafio@bruningsistemas.com.br',
      apiPassword: process.env.NUXT_API_PASSWORD || 'password'
    }
  }
})
