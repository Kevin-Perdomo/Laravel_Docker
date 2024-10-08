{{-- <!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Super Gestão - Contato</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}">
</head>

<body> --}}

    @extends('site.layouts.basico')

    @section('titulo', 'Contato')

    @section('conteudo')
    <div class="topo">

        <div class="logo">
            <img src="{{ asset('img/logo.svg')}}">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('site.home') }}">Principal</a></li>
                <li><a href="{{ route('site.contato') }}">Contato</a></li>
                <li><a href="{{ route('site.sobrenos') }}">Sobre Nós</a></li>
            </ul>
        </div>
    </div>

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">

                <!-- Formulário de contato -->
                <form action="{{ route('site.contato') }}" method="POST">
                    @csrf
                    <input name="nome" type="text" placeholder="Nome" required class="borda-preta">
                    <br>
                    <input name="telefone" type="text" placeholder="Telefone" required class="borda-preta">
                    <br>
                    <input name="email" type="text" placeholder="email" required class="borda-preta">
                    <br>
                    <select name="motivo_contato" class="borda-preta">
                        <option value="">Qual o motivo do contato?</option>
                        <option value="1">Dúvida</option>
                        <option value="2">Elogio</option>
                        <option value="3">Reclamação</option>
                    </select>
                    <br>
                    <textarea name="mensagem" required class="borda-preta">Preencha aqui a sua mensagem</textarea>
                    <br>
                    <button type="submit" class="borda-preta">ENVIAR</button>
                </form>

                <!-- Exibir mensagem de sucesso -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="rodape">
        <div class="redes-sociais">
            <h2>Redes sociais</h2>
            <img src="{{ asset('img/facebook.svg')}}">
            <img src="{{ asset('img/linkedin.svg')}}">
            <img src="{{ asset('img/youtube.svg')}}">
        </div>
        <div class="area-contato">
            <h2>Contato</h2>
            <span>(11) 3333-4444</span>
            <br>
            <span>supergestao@dominio.com.br</span>
        </div>
        <div class="localizacao">
            <h2>Localização</h2>
            <img src="{{ asset('img/mapa.svg')}}">
        </div>
    </div>
</body>

</html>
@endsection