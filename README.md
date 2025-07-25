# Motivação

Nas unidades, muitos setores precisam acessar os dados mínimos de alunos,
funcionários e docentes, esses dados são replicados e as consultas 
estão abstraídas no projeto [replicado](https://github.com/uspdev/replicado). 

Esse projeto, consiste em uma interface web para tornar o acesso a esses dados 
mais fácil, para os setores/pessoas que tem essa permissão.

![Home screen](docs/home_screen.png)

## Características

* Busca por número USP, nome e diversos outros campos;
* Lista de pós graduação, designados e afastados;
* Possui campos extras em banco local;
* usuário pode ter acesso completo (role pessoas) ou acesso restrito (permissões específicas);

## Requisitos

* php 8.2
* Um banco de dados local 
* Um token do oauth
* Acesso ao replicado
* Token do Wsfoto (opcional)

## Atualização

#### Versão 2.0.0 de 4/9/2024

* Atualizado para Laravel 11

#### Versão 1.3.0 de 30/01/2024

* Atualizado o senhaunica-socialite para usar permissions
* Necessário atualizar o `.env` (ver `.env.example`)
* Necessário atribuir permissões aos usuários existentes (`role pessoas`) mesmo para admins
* Role pessoas é dividido em:
  *  `basico`: principais informações do replicado
  *  `avançado`: acrescenta vínculos encerrados, telefones e endereço
  *  `complementar`: mostra/edita as informações complementares
* Removido log do sistema para utilizar o do `laravel-tools`
* Removido forcarHttps do código para usar o do laravel-tools
* Utilização de **headerSticky** em vários cards
* Apresentação da foto do lattes quando habilitado no env
* Apresentação de vínculos encerrados (informações mínimas)
* Utilizando mensagens flash do laravel-usp-theme

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

Nesse caso lembre de dar permissão de escrita na pasta `storage` para o usuário que roda o processo do servidor, normalmente o `www-data`. É possivel também usar o módulo do apache2 mpm_itk para alterar o usuário do virtualhost.

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
