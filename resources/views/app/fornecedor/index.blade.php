<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedor</title>
</head>

<body>
    {{-- Sintaxe de comentário para o motor de renderização de views [Blade] --}}
    <h3>Fornecedor (view)</h3>

    {{-- Sintaxe de inserir código php no motor de renderização de views [Blade] --}}
    @php
        //Aqui dentro volta a ter a sintaxe do php
        /*
        então
        podemos
        comentar
        normalmente
        */

        $description = 'Motor de renderização de views [Blade]';
        echo $description;
    @endphp

    {{-- @dd($fornecedores) --}}
    <br>
    <br>
    <br>
    <h3>Fornecedores</h3>

    {{-- Teste Lógico --}}
    @if (count($fornecedores) > 0 && count($fornecedores) < 10)
        <h3> Existem alguns Fornecedore cadastrados </h3>
    @elseif(count($fornecedores) >= 10)
        <h3> Existem vários Fornecedore cadastrados </h3>
    @else
        <h3>Ainda não existem Forncedors cadastrados</h3>
    @endif

    {{-- @dd($insumo) --}}
    <br>
    <h3>Insumos</h3>
    Preço:{{ $insumo[1]['preco'] ?? 'Dado não preenchido'}}
    <br>
    Validade:{{ $insumo[1]['validade'] ?? 'Dado não preenchido'}}
    <br>
    Status:{{ $insumo[1]['status'] ?? 'Dado não preenchido'}}
    <br>

    {{-- Teste Lógico --}}
    @if (!($insumo[0]['status'] == 'Ativo'))
        <!-- Executa de o retorno da condição for true-->
        Status:Inativo
    @endif
    <br>
    @unless ($insumo[0]['status'] == 'Ativo')
        <!-- Executa de o retorno da condição for false-->
        Status:Inativo
        <br>
        <br>
    @endunless

    {{--
    //Teste @isset() 
    @isset($insumo)
        <h4>Teste de isset: Variável existente</h4>
    @endisset
    --}}

    <h3>Fornecedores</h3>
    <br><hr>
    @isset($fornecedores)
    @foreach($fornecedores as $indice => $fornecedor)
        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? '' }}
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? '' }}) {{ $fornecedor['telefone'] ?? '' }}
        <hr>
    @endforeach
    @endisset

</body>

</html>
