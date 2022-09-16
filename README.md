<p align="center">
  <img width="460" height="300" src="https://user-images.githubusercontent.com/32068444/190035647-c00e8c36-c370-41f1-a99b-e48bfd09c7ce.svg">
</p>

# Seletiva Back-end PHP Pleno - 26655

- [Link do test](https://docs.google.com/document/d/1U4-DS-Vt8zt5pEoTGc2wiFv-Zt7MHurG6n_6QWOovrs/edit#heading=h.3oakqlcnrn94) 

## Obrigatório para rodar o projeto

- [docker](https://docs.docker.com/get-docker/) 20.10.17

## Descrição

O projeto foi desenvolvido com as seguintes técnologias

- [docker](https://docs.docker.com/get-docker/) 20.10.17
- [docker-compose](https://docs.docker.com/compose/install/) 1.29.2
- [php](https://www.php.net/releases/8.1/en.php) 8.1.0
- [laravel](https://laravel.com/docs/8.x/releases) 8.61.0
- [mysql](https://dev.mysql.com/doc/relnotes/mysql/8.0/en/) 8.0.26
- [PHPunit](https://phpunit.readthedocs.io/en/9.5/) 9.5.10
- [composer](https://getcomposer.org/doc/00-intro.md) 2.1.9

- [git](https://git-scm.com/doc) 2.33.1
- [github](https://docs.github.com/pt) 1.0.0
- [git actions](https://docs.github.com/pt/actions) 1.0.0




## Diagrama de Classes
![velty-test](https://user-images.githubusercontent.com/32068444/190558722-fb9ce555-0076-4ae4-852f-b3a483071ae6.jpg)



# Executando o projeto
## Para saber os comandos artisan disponíveis

Use docker `./docker/bin/sail artisan help` command to executa artisan commands or access docker bash shell with `./docker/bin/sail bash` and execute the command `php artisan help`.


## Para rodar o projeto execute o script Shell

``` bash
sh init.sh
```

## Ou  Execute os comandos manualmente para rodar o projeto

01. Execute o comando `cp .env.example .env` para cria o arquivo de configuração do projeto.
02. Execute o comando `./docker/bin/sail build` para construir a imagem do projeto.
03. Execute o comando `./docker/bin/sail up -d  --remove-orphans`  para subir os containers do projeto.
04. Execute o comando `./docker/bin/sail compose install` para instalar as dependências do projeto.
05. Execute o comando `./docker/bin/sail artisan key:generate` para gerar a chave do projeto.
06. Execute o comando `./docker/bin/sail artisan migrate:fresh --seed` para criar as tabelas e popular o banco de dados.
07. Execute o comando `./docker/bin/sail artisan storage:link` para criar o link simbólico para o diretório de armazenamento do projeto.
08. Execute o comando `./docker/bin/sail artisan test`  para executar os testes do projeto.
09. Execute o comando `./docker/bin/sail bash` para acessar o bash do container do projeto.

## Documentação da api

... 10. Execute o comando `./docker/bin/sail php artisan scribe:generate` para gerar a documentação da api.

Clique [aqui](http://localhost:9000/docs) para acessar a documentação da api.
