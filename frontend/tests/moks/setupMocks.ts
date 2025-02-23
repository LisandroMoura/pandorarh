import { vi } from 'vitest'
export const setupMocks = () => {

// Mock dos composables
vi.mock('~/composables/useNotify', () => ({
  useNotify: () => ({
    notify: vi.fn()
  })
}))

vi.mock('~/composables/useFetchAuth', () => ({
  useFetchAuth: () => ({
    authFetch: vi.fn().mockResolvedValue({})
  })
}))

vi.mock('~/composables/useApiErrorHandler', () => ({
  useApiErrorHandler: () => ({
    handleError: vi.fn()
  })
}))

// Mock do useRouter
vi.mock('vue-router', () => ({
  useRouter: () => ({
    push: vi.fn()
  })
}))

// Mock do useRuntimeConfig
vi.mock('nuxt/app', () => ({
  useRuntimeConfig: () => ({
    public: {
      apiBaseUrl: 'http://localhost:3000/api'
    }
  }),
  refreshNuxtData: vi.fn()
}))
 
}