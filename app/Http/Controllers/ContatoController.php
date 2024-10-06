<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function Contato()
    {
        // var_dump($_POST);
        return view('site.contato');
    }

    public function store(Request $request)
    {
       
        // Criar novo formulario de contato
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        $contato->save();

        return redirect()->back()->with('success', 'Contato enviado com sucesso!');
    }
}
