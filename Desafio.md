# Sobre o Desafio:

| Um resumo do que foi desenvovido neste teste

### Backend

Sistema Laravel para o fornecimento de uma API robusta e consistente.

**Recursos do Laravel Implementados:**

*   **Padrão de Projetos:** Arquitetura MVC (Model-View-Controller) para organização do código e implementação de controllers para rotas do tipo "resources".
*   **Segurança:** Autenticação de API via Laravel Sanctum para proteção dos endpoints.
*   **Validações e consistência de dados:** Implementação de `Validators` e `Rules` customizadas para garantir a integridade dos dados na camada de backend:
    *   `app/Rules/CpfValidate.php`: Validação de CPF válidos bem como duplicidade de CPF na base de dados.
    *   `app/Rules/DataNascimentoValidate.php`: Validação da idade (maior de 18 anos).
    *   `Duplicidade de cadastro`: Validações impedindo repetições de CPF e email no sistema.

*   **Testes Unitários:** Testes automatizados com PhpUnit para validação de cadastros e autenticação:
    *   `tests/Feature/AuthControllerTest.php`: Testes para cadastro de usuário e login.
    *   `tests/Feature/FuncionarioTest.php`: Testes para o CRUD e funcionamento geral da API.
    *   Para executar os testes, navegue até a pasta do backend e execute: `php artisan test`

### Frontend

*   **Layout:** Componentização de páginas para um layout modular e reutilizável.
    *   Reutilização de componentes, como `components/Funcionario/Form.vue`, para cadastro, edição e visualização de colaboradores.
*   **Componentização de Objetos de Formulário:** Criação de componentes customizados:
    *   `Input.vue`: Componente de input customizado para o layout.
    *   `Select.vue`: Componente de select customizado para o layout.
*   **Formatação e Máscaras em Campos Numéricos:** Implementação do componente `Form/CustomInputFormat.vue` para aplicar máscaras a campos numéricos (CPF, Telefone, valores financeiros, RG, etc.).
*   **Composables:** Utilização de composables para reaproveitamento de lógica
    *   `useFetchAuth.ts`: Hook para requisições autenticadas, login na API e gestão do token no `localStorage`.
    *   `useApiErrorHandler.ts`: Hook para tratamento de erros da API.
