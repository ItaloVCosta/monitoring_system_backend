
# Monitoring System Backend

Este repositório contém o código-fonte do backend para o projeto **Monitoring System**, desenvolvido para monitorar e gerenciar recursos de servidores. Ele é projetado para ser executado dentro de contêineres Docker, garantindo uma instalação rápida e fácil em qualquer ambiente.

## Pré-requisitos

Antes de começar, verifique se você tem o [Docker](https://docs.docker.com/get-docker/) e o [Docker Compose](https://docs.docker.com/compose/install/) instalados no seu sistema.

## Configuração do Projeto

Siga as etapas abaixo para configurar e executar o projeto.

### 1. Clone o Repositório

```bash
git clone https://github.com/ItaloVCosta/monitoring_system_backend.git
cd monitoring_system_backend
```

### 2. Inicie os Contêineres com Docker Compose

Para construir e iniciar os contêineres, execute o comando abaixo. Ele irá configurar o ambiente de desenvolvimento com todos os serviços necessários:

```bash
docker-compose up --build
```

> **Nota:** O parâmetro `--build` é usado para garantir que todas as alterações sejam refletidas nos contêineres ao inicializá-los.

### 3. Instale as Dependências do Composer

Após os contêineres estarem em execução, abra um novo terminal e execute o comando `composer install` dentro do contêiner do PHP:

```bash
docker-compose exec php_server composer install
```

Esse comando instalará todas as dependências necessárias para o projeto.

### 4. O Projeto Está Pronto!

Com os passos acima concluídos, o backend está pronto para receber requisições. A URL padrão da API é: [http://localhost:8000](http://localhost:8000).

Para verificar se o projeto está funcionando corretamente, você pode acessar o endereço configurado no navegador ou testar uma das rotas usando um cliente HTTP, como o [Postman](https://www.postman.com/).

## Comandos Úteis

Aqui estão alguns comandos úteis para gerenciar o ambiente de desenvolvimento:

- **Parar os contêineres**:
  ```bash
  docker-compose down
  ```

- **Reiniciar os contêineres**:
  ```bash
  docker-compose restart
  ```

- **Acessar o contêiner PHP**:
  ```bash
  docker-compose exec php_server bash
  ```

