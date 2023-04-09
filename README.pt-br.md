# PHP API TO-DO-LIST v.2.0

<code><img height="50" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/php/php.png"></code>
<code><img height="50" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/mysql/mysql.png"></code>

Esta API tem como objetivo apresentar uma visão geral para o consumo recursos e interação com uma API, principalmente para alunos dos primeiros anos dos cursos de Ciência da Computação e afins. Assim, possui EndPoints (recursos) para serrem utilizados, podendo ser expandidos conforme a necessidade.

Por se tratar de um projeto instrucional **não é recomendado** que seja aplicado em ambiente de produção, pois não foram implantadas rotinas e testes de segurança. Esses recursos devem ser pesquisados e implementados, obedecendo às normas vigentes, além das boas práticas. Construída em **PHP 7** (veja abaixo), permite ao iniciante entender os mecanismos de acesso aos recursos de uma API.

```html
PHP 7.4.3 (cli) (built: Jul  5 2021 15:13:35) ( NTS )
Copyright (c) The PHP Group Zend Engine v3.4.0, 
Copyright (c) Zend Technologies with Zend OPcache v7.4.3, 
Copyright (c), by Zend Technologies
```

## Como usar esse conteúdo?

Este conteúdo é livre para uso e distribuição sob a licença (CC BY-SA 4.0).

Se quiser colaborar neste repositório com quaisquer melhorias que você tenha feito, basta fazer um _fork_ e enviar um PR.

## Composer

Mudanças devem ser atualizadas via <code>composer dump-autoload -o</code> no ambiente de desenvolvimento.

# Documentação

Esta API fornece funcionalidades para criar e manter usuários para controlar um aplicativo simples de lista de tarefas pendentes. A
seguir é mostrada a estrutura da API para os recursos de **usuários** e **tarefas**.

## Estrutura da API

```
+---api
    \task\
        ---delete
        ---edit
        ---new
        ---search
        ---update
    \user\
        ---new
        ---login
        ---update
        ---updateuserpass
        ---delete
+---src
    \---Database
    \---Helpers
    \---Task
    \---User
\---vendor
    \---composer
```

## _Database_

Esta API utiliza o banco de dados MySQL 5, que pode ser alterado a qualquer momento de acordo com a necessidade de uso. O banco de dados deve ser
configurado em <code>Database\Database.php</code>.

### Scripts SQL

```sql
CREATE DATABASE name;
```

```sql
CREATE TABLE users
(
    id       INT(3)         NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name     VARCHAR(50)    NOT NULL,
    email    VARCHAR(50)    NOT NULL,
    username VARCHAR(32)    NOT NULL,
    password VARCHAR(32)    NOT NULL,
    token    VARCHAR(20)    NOT NULL,
    picture  TEXT           DEFAULT NULL
);
```

```sql
CREATE TABLE tasks
(
    id       INT(3)         NOT NULL PRIMARY KEY AUTO_INCREMENT,
    userId   INT(3)         NOT NULL,
    name     VARCHAR(50)    NOT NULL,
    date     date           NOT NULL,
    realized INT(1)         NOT NULL
);
```

Atenção: a fim de excluir tarefas correspondentes para o usuário, é necessário aplicar as instruções a seguir:

```sql
ALTER TABLE tasks
ADD CONSTRAINT pk_user
FOREIGN KEY (userId)
REFERENCES users(id)
ON DELETE CASCADE;
```

## Token

Para usar esta API, um usuário deve ser criado primeiramente com o recurso abaixo.

Será retornado um **TOKEN** que deve ser usado em todas as solicitações subsequentes para manipulação de dados do usuário e das tarefas.

## URI

A variável `URI` deve ser preenchida com um endereço disponível para a API.

# _Resources_

## User

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **NEW** | `http://URI/api/user/new/` | **POST** |

---

_**payload**_

```json
{
  "name": "name",
  "email": "email",
  "username": "username",
  "password": "password"
}
```

_**header**_

```json
{
  "content-type": "application/json"
}
```

_**Success**_

```json
{
  "message": "User Successfully Added",
  "id": "user_id",
  "token": "TOKEN value"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Four)"
}
```

```json
{
  "message": "Could Not Add User"
}
```

```json
{
  "message": "User Already Exists"
}
```

---

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **LOGIN** | `http://URI/api/user/login/` | **POST** |

_**payload**_

```json
{
  "username": "username",
  "password": "password"
}
```

_**header**_

```json
{
  "content-type": "application/json"
}
```

_**Success**_

```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john.doe@domain.com",
  "token": "YOUR_TOKEN",
  "picture": "BASE64_STRING"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Two)"
}
```

```json
{
  "message": "Incorrect username and/or password"
}
```

---

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **UPDATE** | `http://URI/api/user/update/` | **PUT** |

_**payload**_

```json
{
  "name": "name",
  "email": "email",
  "username": "username",
  "password": "password",
  "picture": "picture"
}
``` 

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "User Successfully Updated"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Five)"
}
```

```json
{
  "message": "Incorrect username and/or password"
}
```

```json
{
  "message": "Could Not Update User"
}
```
---

---

|           Resource           |                  URI                  |  Method  |
|:----------------------------:|:-------------------------------------:|:--------:|
| **UPDATE USERNAME/PASSWORD** | `http://URI/api/user/updateuserpass/` | **PUT** |

_**payload**_

```json
{
  "username": "username",
  "password": "password",
  "username": "new_username",
  "password": "new_password"  
}
``` 

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "User/password Successfully Updated"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Four)"
}
```

```json
{
  "message": "Incorrect username and/or password"
}
```

```json
{
  "message": "Could Not Update Username/password"
}
```

---
| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **DELETE** | `http://URI/api/user/delete/` | **DELETE** |

_**payload**_

```json
{
  "username": "username",
  "password": "password"
}
``` 

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "User Successfully Deleted"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Two)"
}
```

```json
{
  "message": "Incorrect username and/or password"
}
```

```json
{
  "message": "Could Not Delete User"
}
```

---

# Task

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **NEW** | `http://URI/api/task/new/` | **POST** |

---

_**payload**_

```json
{
  "name": "Task name"
}
```

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "Task Successfully Added"
}
```

_**Warnings**_

```json
{
  "message": "Invalid Arguments Number (Expected Two)"
}
```

```json
{
  "message": "Could Not Add Task"
}
```

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **SEARCH** | `http://URI//api/task/search/` | **POST** |

---

O _Payload_ não é necessário aqui, pois o controle é realizado pelo `token`.

**Realized** aceita valores: `0` (open) or `1` (realized)

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
[
  {
    "id": 1,
    "userId": 1,
    "name": "task name",
    "date": "2021-08-16",
    "realized": 0
  }
]
```

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **UPDATE** | `http://URI/api/task/update/` | **PUT** |

---

_**payload**_

```json
{
  "id": "value",
  "name": "Task name",
  "realized": "value"
}
```

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "Task Successfully Updated"
}
```

_**Warnings**_

```json
{
  "message": "Task(s) not found"
}
```

```json
{
  "message": "Method Not Allowed"
}
```

```json
{
  "message": "Invalid Arguments Number (Expected Three)"
}
```

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **EDIT** | `http://URI/api/task/edit/` | **POST** |

---

_**payload**_

```json
{
  "id": "value"
}
```

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
"id": 2,
"userId": 1,
"name": "Task name",
"date": "2021-08-16",
"realized": 0
}
```

_**Warnings**_

```json
{
  "message": "Payload Precondition Failed"
}
```

```json
{
  "message": "Invalid or Missing Token"
}
```

```json
{
  "message": "Invalid Arguments Number (Expected One)"
}
```

```json
{
  "message": "Bad Request (Invalid Syntax)"
}
```

```json
{
  "message": "Token Refused"
}
```

| Resource |      URI      |  Method  |
|:--------:|:-------------:|:--------:|
|  **DELETE** | `http://URI/api/task/delete/` | **DELETE** |

---

_**payload**_

```json
{
  "id": "id_task"
}
``` 

_**header**_

```json
{
  "content-type": "application/json",
  "Authorization": "YOUR_TOKEN"
}
```

_**Success**_

```json
{
  "message": "Task deleted Successfully"
}
```

```json
{
  "message": "Task not exist"
}
```

---
_**Other Warnings**_

```json
{
  "message": "Bad Request (Invalid Syntax)"
}
```

```json
{
  "message": "Token Refused"
}
```

```json
{
  "message": "Invalid or Missing Token"
}
```

```json
{
  "message": "Payload Precondition Failed"
}
```

```json
{
  "message": "Method Not Allowed"
}
```

```json
{
  "message": "<SQL Code>"
}
```

```json
{
  "message": "<Unknown>"
}
```

---

<a name="tryonline"></a>

## Teste Online

A API pode ser testada no endereço abaixo, apresentando todas as funcionalidades.

- URI: [https://todolist-api.edsonmelo.com.br/](https://todolist-api.edsonmelo.com.br/)

--- 

## Flutter APP ToDoList

As funcionalidades podem ser testadas através do APP desenvolvido em Flutter acessando  
[aqui](https://github.com/Wilian-N-Silva/flutter_to_do_list). O APP foi desenvolvido por [Wilian Silva](https://github.com/Wilian-N-Silva).

### Telas
![Alt text](images/telas.png "APP Views")
___

## Como citar este conteúdo

```
DE SOUZA, Edson Melo (2021, August 16). PHP API TO-DO-LIST v.2.0.
Available in: https://github.com/EdsonMSouza/php-api-to-do-list
```

Ou BibTeX for LaTeX:

```latex
@misc{desouza2020phpapi,
  author = {DE SOUZA, Edson Melo},
  title = {PHP API TO-DO-LIST v.2.0},
  url = {https://github.com/EdsonMSouza/php-api-to-do-list},
  year = {2021},
  month = {August}
}
```

## Agradecimentos

* [Arthur Timoteo](https://github.com/arthur-timoteo)
  
* [Wilian Silva](https://github.com/Wilian-N-Silva)

## Licença

[![CC BY-SA 4.0][cc-by-sa-shield]][cc-by-sa]

Este trabalho é licenciado sob a
[Creative Commons Attribution-ShareAlike 4.0 International License][cc-by-sa].

[![CC BY-SA 4.0][cc-by-sa-image]][cc-by-sa]

[cc-by-sa]: http://creativecommons.org/licenses/by-sa/4.0/

[cc-by-sa-image]: https://licensebuttons.net/l/by-sa/4.0/88x31.png

[cc-by-sa-shield]: https://img.shields.io/badge/License-CC%20BY--SA%204.0-lightgrey.svg