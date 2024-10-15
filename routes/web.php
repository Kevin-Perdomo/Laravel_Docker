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

// Debug
Route::get('/debug', function () {
    return view('debug');
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

// Teste de Email Mailpit
Route::get('/send-test-email', function () {
    \Mail::raw('Este é um e-mail de teste.', function ($message) {
        $message->to('seu_email@example.com')
                ->subject('Teste de E-mail');
    });

    return 'E-mail de teste enviado!';
});

// Teste de erro
Route::get('/test-error', function () {
    throw new \Exception('Este é um erro de teste!');
});