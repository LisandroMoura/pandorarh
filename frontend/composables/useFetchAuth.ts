import { $fetch } from 'ofetch'
/**
 * Hook para fazer requisições autenticadas, 
 * Fazendo o login na API e utilizando o token armazenado no localStorage
 */
export const useFetchAuth = () => {
  /**
   * Metodo responsavel por fazer o login na API, obtento o token 
   * e armazenando no localStorage
   */
  const authLogin = async () => {
    // importanto as variáveis de ambiente do config
    const config = useRuntimeConfig();
    try {
      const response = await $fetch(`${config.public.apiBaseUrl}/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: {
          email: config.public.apiUser,
          password: config.public.apiPassword
        }
      })

      // obtendo o token e armazenando no localStorage
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

  /**
   * Metodo que executa as requisições com autenticação
   */
  const authFetch = async (url: string, options: any = {}) => {
    // let token = localStorage.getItem('pandoraToken')

    // Verifica se o token existe, caso não existir, vamos fazer o login no backend
    // if (!token) {
    //   token = await authLogin() // Aguarda o login antes de continuar
    //   if (!token) throw new Error('Não foi possível obter o token')
    // }

    return await $fetch(url, {
      ...options,
      headers: {
        'Content-Type': 'application/json',
        // Authorization: `Bearer ${token}`,
        ...options.headers
      }
    })
  }

  return { authFetch, authLogin }
}
