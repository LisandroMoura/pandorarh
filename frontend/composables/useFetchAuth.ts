import { $fetch } from 'ofetch'

export const useFetchAuth = () => {
  // Método de login
  const authLogin = async () => {
    try {
      const response = await $fetch('http://localhost:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: {
          email: 'lisandro@pandora.io',
          password: 'password'
        }
      })

      if (response.token) {
        localStorage.setItem('pandoraToken', response.token) // Armazena o token no localStorage
        console.log('Login bem-sucedido! Token:', response.token)
        return response.token
      } else {
        console.error('Erro no login: Token não recebido')
        return null
      }
    } catch (error) {
      console.error('Erro na requisição:', error)
      return null
    }
  }

  // Método de requisição autenticada
  const authFetch = async (url: string, options: any = {}) => {
    let token = localStorage.getItem('pandoraToken')

    if (!token) {
      token = await authLogin() // Aguarda o login antes de continuar
      if (!token) throw new Error('Não foi possível obter o token')
    }

    return await $fetch(url, {
      ...options,
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
        ...options.headers
      }
    })
  }

  return { authFetch, authLogin }
}
