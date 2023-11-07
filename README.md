
### Passo a passo

Crie o Arquivo .env

```sh

cp .env.example  .env

```


Atualize as variáveis de ambiente do arquivo .env

```dosini

APP_NAME=Laravel

APP_ENV=local

APP_KEY=

APP_DEBUG=true

APP_URL=http://localhost

  

LOG_CHANNEL=stack

LOG_DEPRECATIONS_CHANNEL=null

LOG_LEVEL=debug

  

DB_CONNECTION=mysql

DB_HOST=db

DB_PORT=3306

DB_DATABASE=laravel

DB_USERNAME=root

DB_PASSWORD=root

  

```

  

Suba os containers do projeto

```sh

docker-compose up  -d

```

  
  

Acesse o container app

```sh

docker-compose exec  app  bash

```

  
  

Instale as dependências do projeto

```sh

composer install

```

  
  

Gere a key do projeto Laravel

```sh

php artisan  key:generate

```

Execute o comando artisan para gerar a estrutura do banco de dados

```sh

php artisan  migrate

```

O Laravel utilizará a rota:

[http://localhost:8181](http://localhost:8181)
