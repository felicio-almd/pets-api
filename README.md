<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# RestAPI project for [ENCOMP](https://www.encomp.com.br/) backend course

Uma API RESTful desenvolvida para gerenciar os atributos dos pets da UFES. Esta API foi criada em PHP utilizando o framework Laravel e armazena os dados em um banco de dados PostgreSQL/MYSQL, projeto utilizado como base para aula do minicurso de backend ministrando no ENCOMP(encomp.com.br) para que os alunos tenham fundamentos de orientação a objetos, aprendam crud e boas práticas de programação.

## Visão Geral

A API fornece acesso a informações detalhadas sobre os pets, permitindo que os usuários consultem atributos. Ideal para desenvolvedores que desejam integrar dados dos pets em suas aplicações.

## Funcionalidades

- **Consulta de Pets**: A API permite que os usuários acessem informações sobre os pets, incluindo seus atributos.
- **CRUD**: É possível criar, ler, atualizar e excluir dados dos pets.

## Tecnologias

- **Backend**: PHP com Laravel
- **Banco de Dados**: PostgreSQL/MySQL
- **Hospedagem**: [Fly.io](https://fly.io)

## Como Começar

### Pré-requisitos

- PHP (versão recomendada)
- Composer
- PostgreSQL

### Instalação

1. Clone o repositório:
 ```bash
 git clone https://github.com/felicio-almd/pets-api.git
 cd pets-api
 ```
2. Instale as dependências:
 ```bash
 composer install
 ```
3. Configure o arquivo `.env` com as credenciais do banco de dados PostgreSQL.
4. Execute as migrations para configurar o banco de dados:
 ```bash
 php artisan key:generate
 php artisan storage:link
 php artisan migrate
 ```
5. Inicie o servidor:
 ```bash
 php artisan serve
 ```

## Endpoints

| Método | Endpoint                | Descrição                     |
|--------|-------------------------|-------------------------------|
| GET    | /api/pets               | Retorna todos os pets         |
| POST   | /api/pet                | Cria um novo pets             |
| GET    | /api/pet/{id}           | Retorna um pets específico    |
| PUT    | /api/pet/{id}           | Atualiza um pets específico   |
| DELETE | /api/pet/{id}           | Remove um pet específico      |

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.

## MADE BY FELICIO

