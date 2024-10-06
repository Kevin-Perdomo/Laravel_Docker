<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '0',
                'ddd' => '11', //São Paulo (SP)
                'telefone' => '0000-0000'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '85', //Fortaleza (CE)
                'telefone' => '0000-0000'
            ],
            2 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '32', //Juiz de fora (MG)
                'telefone' => '0000-0000'
            ]
        ];

        $insumo = [
            0 => ['preco' => 'R$: 60,00', 'validade' => '22/08/2025', 'status' => 'Inativo']
        ];

        /*
        //Teste de operador condicional ternário 
        //condição ? se for verdade : se for falso
        echo isset($insumo [0]['validade']) ? 'Validade informada' : 'Validade não informada';
        */
        
        return view('app.fornecedor.index', compact('fornecedores',  'insumo'));
    }
}
