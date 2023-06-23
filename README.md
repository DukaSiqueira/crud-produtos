# Gerenciamento de Tarefas

Este projeto consiste em um gerenciador de tarefas, onde é possível criar, editar, ler e excluir as mesmas. É uma ferramenta essencial para o gerenciamento eficiente e organizado das atividades diárias, proporcionando uma maneira simplificada de lidar com as tarefas e melhorar a produtividade.

### Especificações

O aplicativo foi desenvolvido utilizando o framework Laravel 10 e utiliza o banco de dados MySQL. A autenticação é realizada via JWT, utilizando a biblioteca Tymon e sua documentação foi escrita em Swagger.

### Detalhes do projeto

O padrão utilizado no projeto é o MVC, mas não conta com front-end, apenas a documentação em Swagger utiliza a camada View. Foram criadas algumas classes personalizadas para lidar com as requisições, incluindo validações e exceções customizadas.

### Requisitos

Para rodar o projeto, é necessário:

- PHP >= 8.0
- MySQL 5.7 ou superior
- Composer

## Instalação

1. Clone o repositório para o seu ambiente local.
2. No diretório do projeto, execute o comando `composer install` para instalar as dependências do Laravel.
3. Crie um banco de dados vazio no MySQL.
4. Crie uma cópia do arquivo `.env.example` e renomeie para `.env`. Configure as variáveis de ambiente relacionadas ao banco de dados com as informações do banco criado.
5. Execute o comando `php artisan key:generate` para gerar a chave da aplicação.
6. Execute o comando `php artisan jwt:secret` para gerar a senha secreta de autenticação JWT.
7. Execute o comando `php artisan migrate` para criar as tabelas do banco de dados.
8. Execute o comando `php artisan db:seed` para popular o banco de dados com dados iniciais.

## Executando os testes

Para executar os testes de integração, utilize o comando `php artisan test --testsuite=Feature`.

Obs.: Poderia ser criado um ambiente de teste, mas para facilitar o desenvolvimento utilizei o banco local de desenvolvimento mesmo.

## Documentação

A documentação dos endpoints da API está disponível no Swagger. Para acessá-la, siga os passos abaixo:

1. Inicie o servidor local executando o comando `php artisan serve`.
2. Acesse a URL `http://localhost:8000/api/documentation` em um navegador para visualizar a documentação interativa dos endpoints da API.

Obs.: A documentação poderia ser publicada no SwaggerHUB mas optei por essa forma.
