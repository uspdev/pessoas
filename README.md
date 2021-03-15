# Motivação

Nas unidades, muitos setores precisam acessar os dados mínimos de alunos,
funcionários e docentes, esses dados são replicados e as consultas 
estão abstraídas no projeto [replicado](https://github.com/uspdev/replicado). 

Esse projeto, consiste em uma interface web para tornar o acesso a esses dados 
mais fácil, para os setores/pessoas que tem essa permissão.

![Home screen](docs/home_screen.png)


## Requisitos

* php 7.3
* Um banco de dados local 
* Um token do oauth
* Acesso ao replicado
* Token do Wsfoto (opcional)

## Deploy

Clonar o projeto

    git clone git@github.com:uspdev/pessoas.git

Instalar as dependências do composer

    composer install
    
Copiar o .env.example para .env e editar o necessário

    cp .env.example .env

Rodar o migration

    php artisan migrate

Gerar a chave do laravel

    php artisan key:generate

Você pode rodar em testes usando o servidor embutido

    php artisan serve

## Ambiente de produção

Use seu servidor favorito (ex. Apache) para publicar em produção. 

Nesse caso lembre de dar permissão de escrita na pasta ```storage``` para o usuário que roda o processo do servidor, normalmente o ```www-data```. É possivel também usar o módulo do apache2 mpm_itk para alterar o usuário do virtualhost.

    chown www-data:www-data storage/ -R

Configure no .env

    APP_ENV=production
    APP_DEBUG=false

Rode o composer sem o dev

    composer install --no-dev

## Projetos utilizados

github: [uspdev/replicado](https://github.com/uspdev/replicado)

github: [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite)

github: [uspdev/wsfoto](https://github.com/uspdev/wsfoto)

github: [uspdev/laravel-usp-theme](https://github.com/uspdev/laravel-usp-theme)

## Contribuindo com o projeto

### Passos iniciais

Siga o guia no site do [uspdev](https://uspdev.github.io/contribua)

### Padrões de Projeto

Utilizamos a [PSR-2](https://www.php-fig.org/psr/psr-2/) para padrões de projeto. Ajuste seu editor favorito para a especificação.
