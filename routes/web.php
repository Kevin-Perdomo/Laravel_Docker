<?php

use Illuminate\Support\Facades\Route;

//Uma maneira de reduzir a sintaxe do metodo Route::get
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;

//Rotas na sintaxe padrão do laravel
Route::get('/', function () {
    return view('welcome');
});

Route::get('/server', function () {
    return view('server');
});

//Sintaxe sem a configuração do routeServiceProvide.php
Route::get('/hello', [HelloController::class, 'hello']);

//grupo web (público)
Route::get('/principal', [PrincipalController::class, 'Principal'])->name('site.home');
Route::get('/sobrenos', [SobreNosController::class, 'SobreNos'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'Contato'])->name('site.contato');
Route::post('/contato', [ContatoController::class, 'Contato'])->name('site.contato');

//Rota do Formulário
Route::post('/contato', [ContatoController::class, 'store'])->name('site.contato');

Route::get('/login', function () {return 'login';})->name('site.login');

//grupo app (privado)
Route::prefix('/app')->group(function () {
    Route::get('/clientes', function () {return 'clientes';})->name('app.clientes');
    Route::get('/produtos', function () {return 'produtos';})->name('app.produtos');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores.index');
});

//Redirecionamento de rotas
Route::get('/rota1', function () { echo 'Rota 1';})->name('site.rota1');

//Método 01
/*
Route::get('/rota2', function () { echo 'Rota 2';})->name('site.rota2');
Route::redirect('/rota2', '/rota1',);
*/

//Método 02
Route::get('/rota2', function () { return redirect()->route('site.rota1');})->name('site.rota2');

//Rota de Fallback
Route::fallback(function () 
{
    echo 'Você falhou miseravelmente, essa página não existe. <br> <br>';
    echo '<a href="'.route('site.home').'"> clique aqui </a>';
    echo 'para voltar à página inicial.';
});

//Enviando parâmetros da rota para o contolador
Route::get('/teste/{p1}/{p2}', [TesteController::class, 'Teste'])->name('teste');






















/*
//Passando parâmetros obrigatórios na rota
Route::get(
    '/contato/{id}/{nome}/{sobrenome}/{idade}',
    function (string $id, string $nome, string $sobrenome, string $idade) 
    {
        echo 'Teste de parâmetros: <br>';
        echo 'id: ' . $id . '<br>';
        echo 'nome: ' . $nome . '<br>';
        echo 'sobrenome: ' . $sobrenome . '<br>';
        echo 'idade: ' . $idade . '<br>';
    }
);
*/

/*
//Passando parâmetros opcionais na rota, utilizando expressões regulares
Route::get(
    '/contato00/{nome}/{categoria_id}',
    function (string $nome, int $categoria_id = 1) 
    {
        echo 'nome: ' . $nome . '<br>';
        echo 'categoria: ' . $categoria_id . '<br>';
    }
)->where('nome','[A-Z a-z]+')->where('categoria_id','[0-9]*');
*/