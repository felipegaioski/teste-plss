<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Teste Prático Plss

Aplicação desenvolvida para o teste prático da empresa Plss Soluções.

## Informações

- Versão do php: 8.1.10
- Versão do Laravel: 10.48.29
- Desenvolvido utilizando **[Laragon](https://laragon.org/)**

## Como rodar o projeto

- Clone o projeto. Caso use o Laragon, recomenda-se clonar o projeto na pasta www.
- Execute o comando "composer i" ou "composer u" na pasta do projeto.
- Carregue e execute o arquivo "plss_db.sql" no seu gerenciador de bancos de dados para criar o banco de dados padrão da aplicação.
- Faça uma cópia do arquivo .env.example e renomeie-o para .env. No item "DB_DATABASE" insira o nome que deu ao banco de dados ao criá-lo.
- Execute o comando "php artisan key:generate"
- Caso esteja usando o Laragon, ligue-o. Caso contrário, execute o comando "php artisan serve" para iniciar o projeto.

- Dois usuários estão criados por padrão. Um Administrador e outro Comum. Os logins são:
    - Administrador: email: "admin@admin.com", senha "12345678";
    - Comum: email: "comum@teste.com", senha "12345678";

## Informações

- Este sistema tem como objetivo principal criar e gerenciar (gerenciar envolve criar, editar, deletar) chamados.
- O sistema também possibilita criar e gerenciar usuários, níveis de acesso, permissões e módulos. O Administrador possui por padrão o direito de visualizar e gerenciar usuários e níveis de acesso.
- Apenas ao usuário de nível Administrador é permitido alterar a situação do chamado, iniciando e finalizando.
- O Administrador pode criar novos níveis de acesso e gerenciar as permissões "Visualizar" e "Gerenciar" de cada um deles (Não é permitido, no entanto, que retire suas próprias permissões).
- Há uma página 404 quando uma rota não é encontrada.
- O acesso a cada página ou rota é verificado de acordo com as permissões concedidas a cada nível de acesso. Mesmo quando não há um link visível para a página ou rota, ela estará protegida contra acessos não autorizados.
- As validações retornam toasts para melhor experiência do usuário.
