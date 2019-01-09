# Motivação

Nas unidades, muitos setores precisam acessar os dados mínimos de alunos, funcionários e docentes,
esses dados são replicados e as consultas estão abstraídas no projeto [replicado](https://github.com/uspdev/replicado). 

Esse projeto, consiste em uma interface web para tornar o acesso a esses dados mais fácil, para os setores/pessoas que tem essa permissão.

# Deploy

Assets:

    php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets --force
