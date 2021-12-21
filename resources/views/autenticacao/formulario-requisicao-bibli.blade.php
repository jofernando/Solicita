@extends('layouts.app')

@section('conteudo')
    <!-- @section('navbar')
    Home
@endsection -->
<div class="container" style="min-height:80vh">

    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card card-cadastro">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <h2>Solicitar Documentos Biblioteca</h2>
                    </div>
                    <form method="POST" enctype="multipart/form-data" id="formRequisicao"
                          action="{{ route('cadastrarDocumento') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-sm-12">

                                <label>Aluno</label>
                                <h4>&nbsp{{Auth::user()->name}}</h4>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-12">
                                <label>Perfil</label>
                                <select name="default" class="custom-select custom-select-lg " style="font-size: 90%">
                                @foreach($perfis as $perfil)
                                    <!-- <label for='perfil' style="width: 14.5rem; margin-left:25px"><b>Curso</b></label> -->
                                        <option @if($perfil->valor==true) selected
                                                @endif value="{{$perfil->id}}">{{$perfil->default}}
                                            - {{$perfil->situacao}}</option></br>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-sm-12">
                                <label>Documentos</label>
                                {{-- Declaração de vínculo --}}
                                <div>
                                    <input type="radio" name="documento" value="Monografia"
                                           id="monografia" checked> Monografia</input>
                                </div>
                                {{-- comprovante de matrícula --}}
                                <div>
                                    <input type="radio" name="documento" value="Tese"
                                           id="tese"> Tese</input></br>
                                </div>
                                {{-- Histórico escolar --}}
                                <div>
                                    <input type="radio" name="documento" value="TCC" id="tcc"> Trabalho de Conclusão de
                                    Curso</input></br>
                                </div>

                                {{-- Ficha Catalográfica --}}
                                <div>
                                    <input type="radio" name="documento" value="ProdutoEduc" id="produtoEduc">
                                    Produto Educacional</input></br>
                                </div>
                                <div class="form-group row mb-0" style="margin-top:10px">
                                    <div class="col-md-8 offset-md-4">

                                        <a class="btn btn-secondary" href="{{ route('cancela-requisicao')}}"
                                           style="margin-right:10px">
                                            {{ ('Cancelar') }}
                                        </a>

                                        <button type="submit" class="btn btn-primary-lmts"
                                                style="margin-right:10px">
                                            {{ ('Solicitar') }}
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"
>
@endsection
