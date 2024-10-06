
# Laravel Web Site
[Documentation](https://laravel.com/)

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

### Procedimento para prosseguir com o setup
```bash
sail build
sail up  
sail php artisan key:generate
```

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

### Resolvendo conflito de volume do contêiner MySQL
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
select * from migrations;
describe fornecedores;
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
sail artisan db:seed
sail artisan migrate:fresh --seed
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