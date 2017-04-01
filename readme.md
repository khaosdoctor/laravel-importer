# Instruções

## Inicialização do repositório

1. Crie um arquivo `database.sqlite` na pasta database
2. Renomeie o arquivo `.env.example` para `.env` (os dados de ambiente já estão configurados para utilizar o SQLite como datasource)

## Execução em browser

Basta executar `php artisan serve`

> Arquivo de importação incluso em `storage`

Acionar o worker da fila com `php artisan queue:work database`

## DB

SQLite localhost, executar o comando `php artisan migrate`

## Testes

Para cada execução total, limpar o banco com `php artisan migrate:refresh` antes de executar `php artisan dusk` para iniciar os testes.

### Queue

Para que os testes corram normalmente, executar o inicalizador da fila com `php artisan queue:listen database --tries 2`
