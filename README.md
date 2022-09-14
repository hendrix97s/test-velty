<p align="center">
  <img width="460" height="300" src="https://user-images.githubusercontent.com/32068444/190035647-c00e8c36-c370-41f1-a99b-e48bfd09c7ce.svg">
</p>


## Descrição

## Diagrama de Classes

# Executando o projeto

 1. execute o comando `cp .env.example .env` para criar o arquivo de configuração do projeto
 2. execute o comando `./docker/bin/sail build` para construir a imagem do projeto
 3. execute o comando `./docker/bin/sail up -d` para subir o container do projeto
 4. execute o comando `./docker/bin/sail composer install` para instalar as dependências do projeto
 5. execute o comando `./docker/bin/sail artisan key:generate` para gerar a chave do projeto
 6. execute o comando `./docker/bin/sail artisan migrate` para executar as migrations do projeto
 7. execute o comando `./docker/bin/sail artisan db:seed` para executar os seeders do projeto
 8. execute o comando scribe generate para gerar a documentação da API

# Executando o projeto em modo automatico

 1. execute o comando shell `./init` para construir a imagem do projeto e subir o container automaticamente.
