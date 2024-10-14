
# Laravel 

<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg">
</div>

## Sobre Laravel

Laravel é um framework PHP moderno e elegante, voltado para o desenvolvimento rápido de aplicações web com um código expressivo e sintaxe clara. Ele oferece um robusto conjunto de ferramentas e uma arquitetura flexível, facilitando o desenvolvimento de aplicações desde simples APIs até sistemas complexos.

## Recursos

- **Arquitetura MVC**: Facilita a organização do código.
- **Sistema de Rotas**: Rotas simples e expressivas.
- **Segurança**: Proteção contra CSRF, XSS, entre outros.
- **Eloquent ORM (Object-Relational Mapping)**: Um poderoso ORM para trabalhar com banco de dados.

## Links úteis

- [Documentação oficial](https://laravel.com/docs)
- [Repositório GitHub](https://github.com/laravel/laravel)
- [Comunidade Laravel](https://laracasts.com/)

## Criando um projeto Laravel completo com Docker

- `example-app` pode ser qualquer nome do projeto
```bash
curl -s https://laravel.build/example-app | bash
cd example-app
```

### Subindo os containers
```bash
./vendor/bin/sail up
```

### Criando as tabelas do banco de dados
```bash
./vendor/bin/sail artisan migrate
```

## Criando um Alias para rodar comandos Sail
```bash
ls -la
sudo nano .bashrc
```
- Copiar o comando abaixo, colar e salvar dentro do arquivo `.bashrc`:
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)' 
```

### Testando o Alias
```bash
sail --help
sail up
sail up -d
sail stop   // Para os contêineres, mas mantém o estado, redes e volumes.
sail down   // Para os contêineres e remove as redes, volumes e outros recursos associados.
```

## Testando o servidor Apache (para evitar conflitos)
```bash
sudo lsof -i :80
sudo service apache2 stop
```

## Testando Artisan
```bash
sail artisan --help
sail artisan make:controller Name_Controller
sail artisan make:model Fornecedores -m     // O parametro -m cria uma migration associada ao modelo
OR 
sail artisan make:model Fornecedores
sail artisan make:migration create_fornecedores_table
sail artisan migrate
sail artisan migrate:rollback
sail artisan route:list --help
sail artisan route:list -v
sail artisan route:list
```

## Rodando em uma nova máquina a partir de um git clone
- Laravel Sail é um orquestrador de Docker Compose, ou seja, ele ajuda a subir e controlar os contêineres do projeto Laravel.
- A pasta `vendor` do projeto Laravel está listada no arquivo `.gitignore` por padrão, ou seja, não é versionado e não consta no projeto que clonei.
- A documentação [Documentation](https://laravel.com/docs/11.x/sail#introduction) fala sobre um comando que deve ser executado na pasta do projeto recém-clonado 
  em uma nova máquina para que passe a ter novamente os comandos 'sail' (com o alias) disponíveis no ambiente local (fora dos contêineres):
```bash
cd <pasta do projeto>
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

- Sobre as variáveis de ambiente que sentimos falta na hora de executar `docker compose up`:
- devemos deixar os comandos de Docker Compose de lado e usar sempre o comando `sail`, pois o arquivo `vendor/laravel/sail/bin/sail` tem variáveis
  de ambiente como `WWWUSER` e `WWWGROUP` que são usados pelos contêineres.
- Por isso, as linhas do Docker Compose que contêm `WWWGROUP` e `WWWUSER` devem ser mantidas em suas versões originais.

### Alterando variáveis de ambiente no arquivo .env
```bash
O banco de dados usaria SQLite, mas configurei para usar o MySQL:
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### Procedimento para prosseguir com o setup
```bash
sail build
sail up  
sail php artisan key:generate
```

### Resolvendo conflito de volume do contêiner MySQL
 - Caso já exista uma instância anterior do MySQL
```bash
docker volume ls  
docker volume rm laravel_docker_sail-mysql  
```

### Depois executei:
```bash
sail artisan config:cache     //Busca os dados de database
sail artisan config:clear     //Limpa o cache de database
sail artisan migrate          // carga inicial da base de dados
sail artisan migrate:status   // lista que as migrações foram executadas
```
 - E consegui acessar a página inicial do projeto 🥲

## Acessando o Banco de Dados pelo Terminal
```bash
docker exec -it laravel_docker-mysql-1 bash
mysql -u sail -p
Enter password: password
SHOW DATABASES;
USE laravel;
SHOW TABLES;
SELECT *FROM migrations;
DESCRIBE fornecedores;
```

## Model Laravel
- Eloquent ORM (Object-Relational Mapping) [Documentation](https://laravel.com/docs/11.x/eloquent)

- O Laravel oferece uma interface interativa chamada Tinker, que permite executar comandos e interagir com os modelos diretamente.
- Execute o comando abaixo no terminal para entrar no Tinker:
```bash
sail artisan tinker
```

- Para listar os registros do modelo Sistema, execute o seguinte comando:
```bash
App\Models\Sistema::all();
```

- Para sair do Tinker
```bash
exit  OR Ctrl + c
```
 - Testando
```bash
sail artisan tinker 
$contato = new \App\Models\SiteContato();
$contato->nome = 'Kevin';
$contato->telefone = '(22) 99899 9899';
$contato->email = 'kevin@gmail.com';
$contato->motivo_contato = 1;
$contato->mensagem = 'teste';
print_r($contato->getAttributes());
$contato->save();
```

## Seeders
[Documentation](https://laravel.com/docs/11.x/seeding)

```bash
sail artisan make:seeder NomeDoSeeder
sail artisan migrate:rollback
sail artisan migrate:reset
sail artisan migrate
sail artisan migrate:refresh
sail artisan db:seed
```
## Mailpit

 - Configurar o `.env`
```bash
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
 - Usar o comando para criar um Mailable e uma View
```bash
sail artisan make:mail TestEmail --markdown test-email
```
 - Criar um comando no `console.php`
```bash
Artisan::command('test-email', function () {
  Mail::to('kevin@gmail.com')->send(new App\Mail\TestEmail());
});
```
 - Usar o comando gerado para enviar um E-mail
```bash
sail artisan test-email
```
## Laravel Sail Debug with Xdebug

### 1. Configurar o Xdebug no php.ini

No diretório `./vendor/laravel/sail/runtimes/8.3`, abra o arquivo `php.ini` e adicione o seguinte trecho:

```ini
xdebug.mode = debug
xdebug.start_with_request = yes
xdebug.discover_client_host = 0
xdebug.discover_client_host = host.docker.internal
```

### 2. Altere a seguinte linha do docker-compose.yml:
```bash
XDEBUG_MODE: '${SAIL_XDEBUG_MODE:-debug}'
```

### 3. Rode os comandos:
```bash
sail build
sail up -d
```
### 4. Instale a extensão para VS Code:
```bash
PHP Debug -> v1.35.0 -> xdebug.org
```

### 5. Crie no VS Code um arquivo launch.json:
```bash
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003, 
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            }
        }
    ]
}
```

## Procedimento de projeto GitLab
```bash
// selecionar uma issue
// criar merge request e branch
git checkout master                            // Troca para a master local
git pull                                       // Atualiza as modificações da master remota
git status                                     // verifica as modificações
git checkout nome_da_branch_referente_a_issue  // Troca para a issue de trabalho
git merge master                               // Atualiza as alterações da master local
```