@extends('layouts.app')

@section('conteudo')
    <!-- @section('navbar')
    Home
@endsection -->

<style>
    hr {
        border: none;
        height: 2px;
        /* Set the hr color */
        color: #333; /* old IE */
        background-color: #1B2E4F; /* Modern Browsers */
        margin-top: 0px;
    }

    .center {
        margin: auto;
        width: 50%;
        padding: 10px;
    }

    h3 {
        font-size: 22px;
        margin-bottom: 5px;
    }

    .form-control {
        width: 97%;
    }
</style>

<div class="container-fluid background-blue" style="min-height:110vh">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card card-cadastro card-cadastro-servidor">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <h2>Ficha Catalográfica - {{$tipo_documento}}</h2>
                    </div>
                    <form>
                        <! –– Dados Pessoais ––>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Dados Pessoais</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-left: 15px;">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nome<span style="color: red">*</span>:</label>
                                    <input type="text" class="form-control" id="nome"
                                           placeholder="Nome" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                           disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <! –– Dados do Trabalho ––>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Dados do Trabalho</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-left: 15px;">
                                <div class="form-group">
                                    <label for="autor">Autor<span style="color: red">*</span>:</label>
                                    <input type="text" class="form-control" id="autor"
                                           placeholder="Digite o nome do Autor" value="">
                                </div>
                                <div class="form-group">
                                    <label for="titulo">Titulo<span style="color: red">*</span>:</label>
                                    <input type="text" class="form-control" id="titulo"
                                           placeholder="Digite o Titulo" value="">
                                </div>
                                <div class="form-group">
                                    <label for="subtitulo">Subtitulo:</label>
                                    <input type="text" class="form-control" id="subtitulo"
                                           placeholder="Digite o Subtitulo" value="">
                                </div>
                                <div class="form-group">
                                    <label for="local">Local<span style="color: red">*</span>:</label>
                                    <input type="text" class="form-control" id="local"
                                           placeholder="Digite o Local" value="">
                                </div>
                                <div class="form-group">
                                    <label for="ano">Ano<span style="color: red">*</span>:</label>
                                    <input class="form-control" type="number" min="1900" max="2099" step="1"
                                           value="{{date('Y')}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="folhas">Folhas<span style="color: red">*</span>:</label>
                                    <input type="number" class="form-control" id="folhas"
                                           placeholder="Digite a Quantidade de Folhas" value="">
                                </div>
                                <div class="form-group">
                                    <label for="ilustracao">Ilustração<span style="color: red">*</span></label>
                                    <select class="form-control" id="ilustracao">
                                        <option value="colorido">Colorido</option>
                                        <option value="preto_branco">Preto e Branco</option>
                                        <option value="nao_possui">Não Possui</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <! –– Dados Especificos ––>
                        @if($tipo_documento == 'Monografia')
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Monografia</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-left: 15px;">
                                    <div class="form-group">
                                        <label for="orientador">Orientador:</label>
                                        <input type="text" class="form-control" id="orientador"
                                               placeholder="Digite o Orientador" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitulo">Titulação do Orientador:</label>
                                        <select class="form-control" id="titulacao_orientador">
                                            <option value="graduado">Graduado</option>
                                            <option value="especialista">Especialista</option>
                                            <option value="mestre">Mestre</option>
                                            <option value="doutor">Doutor</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="orientador">Coorientador:</label>
                                        <input type="text" class="form-control" id="coorientador"
                                               placeholder="Digite o Nome do Coorientador" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitulo">Titulação do Coorientador:</label>
                                        <select class="form-control" id="titulacao_coorientador">
                                            <option value="graduado">Graduado</option>
                                            <option value="especialista">Especialista</option>
                                            <option value="mestre">Mestre</option>
                                            <option value="doutor">Doutor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @elseif(null)

                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Palavras Chave</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-left: 15px;">
                                <div class="form-group">
                                    <label for="primeira">Primeira Palavra:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="primeira"
                                           placeholder="Primeira Palavra Chave" value="">
                                </div>

                                <div class="form-group">
                                    <label for="segunda">Segunda Palavra:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="segunda"
                                           placeholder="Segunda Palavra Chave" value="">
                                </div>

                                <div class="form-group">
                                    <label for="terceira">Terceira Palavra:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="terceira"
                                           placeholder="Terceira Palavra Chave" value="">
                                </div>

                                <div class="form-group">
                                    <label for="quarta">Quarta Palavra:</label>
                                    <input type="text" class="form-control" id="quarta"
                                           placeholder="Quarta Palavra Chave" value="">
                                </div>

                                <div class="form-group">
                                    <label for="quinta">Quinta Palavra:</label>
                                    <input type="text" class="form-control" id="quinta"
                                           placeholder="Quinta Palavra Chave" value="">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
