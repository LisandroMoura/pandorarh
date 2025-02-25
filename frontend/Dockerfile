FROM node:18-alpine

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos de dependências
COPY package*.json ./

# Instala as dependências
RUN npm install --omit=dev


# Copia o restante do código
COPY . .

# Ajusta permissões para pastas críticas
RUN chown -R node:node /app && chmod -R 775 /app
USER node

# Build e início do servidor Nuxt
CMD ["npm", "run", "dev"]