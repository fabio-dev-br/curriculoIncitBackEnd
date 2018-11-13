# Configuração mínima para novos projetos em PHP

## Instalar o Docker e Docker Compose

- Docker (CE): https://docs.docker.com/install/linux/docker-ce/ubuntu/
- Docker Compose: https://docs.docker.com/compose/install/

## Execução com o docker

**IMPORTANTE**: Ao utilizar esse método, remova as pastas `vendor` e `node_modules`, `public/{img,css,js,pjs,fonts}` e os arquivos `composer.lock` e `package-lock.json` se existirem.

- Iniciar o ambiente de desenvolvimento: `docker-compose up`

**Importante**: Como o BrowserSync é executado dentro de um container, o navegador não abrirá sozinho, é necessário clicar na url indicada (interna ou externa)


Acesso de linha de comando para mysql, beanstalk e redis
- `mysql -h 127.0.0.1 -u root -p --port=13306` # mysql (se possuir o mysql instalado em sua máquina, caso contrário, utilize o método de **Informações Gerais**)
- `telnet 127.0.0.1 21300` # beanstalkd


### Informações Gerais:

- Os containers **phpstart-mysql**, **phpstart-node**, **phpstart-beanstalk**, **phpstart-webserver**, **phpstart** executam enquanto o comando `docker-compose up` estiver ativo ou indefinidamente caso estejam sendo executados como *daemon*. É possível acessá-los para execução de comandos adicionais. Ex:

```sh
# atualizar dependências do php
docker exec -it phpstart sh
# instalar uma nova dependência
composer require pimple/pimple
# atualizar as dependências
composer update
```

```sh
# acessa o container phpstart-mysql
docker exec -it phpstart-mysql sh
# rodar comandos dentro do container
mysql -u phpstartadmin -p phpstart
 # (utilize a senha admin)
 ```


## Execução sem o docker (descontinuado)

**IMPORTANTE**: Ao utilizar esse método, remova as pastas `vendor` e `node_modules`, `public/{img,css,js,pjs,fonts}` e os arquivos `composer.lock` e `package-lock.json` se existirem.

Crie um o arquivo settings.local.php em app/config e crie também o usuário e banco de dados.
```php
<?php

return [
    'display_errors' => true,
    'db' => [
        'host' => 'localhost',
        'db_name' => 'phpstart',
        'db_user' => 'root',
        'db_pass' => 'root',
        'charset' => 'utf8mb4'
    ],
    'pheanstalk' => [
        'host' => 'localhost',
        'port' => 11300
    ],
    'jwt' => [
        'app_secret' => 'segredo para geração do token',
        'token_expires' => 1800 // 30 min
    ],
    'session' => [
        'cookie_name' => 'app_ssid',
        'cookie_expires' => 1800 // 30 min
    ],
];

```

- Dependências de sistema:
php7.1 ou maior, mysql-server, redis-server, php-mysql, php-dom, php-mbstring, php-xml, php-redis.

- Dependências de projeto:

```
composer install
npm install grunt-cli -g
npm install
```
- Executar ambiente de desenvolvimento:
    - `grunt dev`
- Executar ambiente de teste:
    - `grunt test`
- Fazer a build do projeto (somente produção):
    - `grunt build`

**Importante**: Para evitar problemas de caching em navegadores, durante o desenvolvimento, recomenda-se desativar o cache na janela de debug (rede) do navegador.

**Melhorias**:

- Criar sessão do usuario;
- inserir bem-vindo (nome do usuario);
- Inserir botão sair ;
- Melhorar interface;
- Arrumar funcionalinade de baixar curriculo;
## Git fuxo

### Subir mudanças

1. git add -A
2. git commit -m "Adiciona funcionalidade xyz"
3. git push

### Baixar mudanças

0. git checkout master
1. git pull

## Gitflow (Vicent)


----------------- hotfix1 (md)--
    /                           \
----------------- master --------o-----------o (v1.2.10)-
                                            /
----------------- dev ---------------o------
    \                               /
     ---------- feature1-branch ----
                                   
     ---------- feature2-branch ----
## Semver (semver.org)

## Rodar o Projeto

## Vuejs

Documentação: https://vuejs.org/v2/guide/
- Vue CLI. 

## Backend
- PHP: php-fig. --> psr-4 (substitui a psr-0)
- Docker e devops

Como acessar os containers:
    



- Entender o backend --> autenticação via token (JWT token)

 o/ ----------------------> WebServer



POST /path HTTP/1.1 $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']
Host: example.com
Authorization: Bearer sjudfhwuei3y45y394583y4i5u34i785y8394rth34fh9038y8934534=435834895eoirthj834y65=

foo=bar&baz=bat

- HTTP Basic autentication
- Bearer token autentication

- Refatorar código

## Evolução do projeto
- Modelagem
- Validação
- Implementação

**Estudar**:
- Rest;
- vuex;
- adr(action domain responder);
- psr1 e psr2
