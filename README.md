# Gerenciamento de Tarefas

Este projeto consiste em um gerenciador de tarefas, onde é possível criar, editar, ler e excluir as mesmas. É uma ferramenta essencial para o gerenciamento eficiente e organizado das atividades diárias, proporcionando uma maneira simplificada de lidar com as tarefas e melhorar a produtividade.

### Especificações

O aplicativo foi desenvolvido utilizando o framework Laravel versão 10 e utiliza o banco de dados MySQL. A autenticação é realizada via JWT, utilizando a biblioteca Tymon e sua documentação foi escrita em Swagger.

### Detalhes do projeto

O padrão utilizado no projeto é o MVC, mas não consta com front-end, apenas a documentação em Swagger utiliza a camada View. Foram criadas algumas classes personalizadas para lidar com as requisições, incluindo validações e exceções customizadas.

### Requisitos

Para rodar o projeto, é necessário ter:

- PHP >= 8.0
- MySQL 5.7 ou superior
- Composer

## Instalação

1. Clone o repositório para o seu ambiente local.
2. No diretório do projeto, execute o comando `composer install` para instalar as dependências do Laravel.
3. Crie um banco de dados vazio e um usuário com acesso ao novo banco no MySQL.
4. Crie uma cópia do arquivo `.env.example` e renomeie para `.env`. 
5. Configure as variáveis de ambiente relacionadas ao banco de dados com as informações do banco criado. As variáveis são: 

*``DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD``*

1. Execute o comando `php artisan key:generate` para gerar a chave da aplicação.
2. Execute o comando `php artisan jwt:secret` para gerar a senha secreta de autenticação JWT.
3. Execute o comando `php artisan migrate` para criar as tabelas do banco de dados.
4. Execute o comando `php artisan db:seed` para popular o banco de dados com dados iniciais.

## Executando os testes

Para executar os testes de integração, utilize o comando `php artisan test --testsuite=Feature`. 

Obs.: Poderia ser criado um ambiente de teste, mas para facilitar o desenvolvimento utilizei o banco local de desenvolvimento.

### Adicional - Testes

Não foi disponibilizado os recursos para cadastrar novos users, porém, ao rodar o comando `php artisan db:seed` na instalação do projeto, gera os seguintes registros:

- 2 usuários:
    
    Esses usuários devem ser utilizados para testes manuais.
    
    | Nome | E-mail | Password |
    | --- | --- | --- |
    | Liberfly User | mailto:User,libuser@example.comibuser@example.com | liberfly123 |
    | Liberfly Test | libtest@example.com | 1liber2fly3 |
- 5 tarefas:
    
    Essas tarefas foram cridas para não ter a necessidade de criar vários registros.
    
    | Title | Description | Status |
    | --- | --- | --- |
    | Alongamento | Alongamento depois de acordar | pending |
    | Estudos | Estudar para a prova de matemática | pending |
    | Janta amigos | Jantar com amigos as 22:00 | pending |
    | Remédio | Tomar remédio as 12:00 | pending |
    | Trabalho faculdade | Trabalho de conclusão de curso | pending |

**OBSERVAÇÃO:** Ao rodar os testes de integração o comando `php artisan db:seed` deve ser rodado novamente, por utilizar o mesmo banco para desenvolver e testar os testes zeram o banco ao terminar de executar.

## Documentação

A documentação dos endpoints da API está disponível no Swagger. Para acessá-la, siga os passos abaixo:

1. Inicie o servidor local executando o comando `php artisan serve`.
2. Acesse a URL `http://localhost:8000/api/documentation` em um navegador para visualizar a documentação interativa dos endpoints da API.

**OBSERVAÇÃO:** A documentação poderia ser publicada no SwaggerHUB, mas optei por essa forma.
