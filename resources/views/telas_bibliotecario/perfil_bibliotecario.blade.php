@extends('layouts.app')

@section('conteudo')
<!-- Informações do bibliotecario -->
@include('componentes.mensagens')

<div class="row justify-content-center">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-header"><h4>Informações do Bibliotecario</h4></div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <label for="nome">Nome</label>
            <h4>{{Auth::user()->name}}</h4>
          </div>
          <div class="col-sm-4">
            <label for="nome">Matricula</label>
            <h4>{{$bibliotecario->matricula}}</h4>
          </div>
          <div class="col-sm-4">
            <label for="nome">E-mail</label>
            <h4>{{$user->email}}</h4>
          </div>
            <div class="col-sm-4">
                <label for="biblioteca">Biblioteca</label>
                <h4>{{$bibliotecaBibliotecario->nome}}</h4>
            </div>
        </div>

      </div>
      <div class="card-footer">
        <div class="">

          <a href="{{route('editar-senha-bibliotecario')}}" class="btn btn-primary-lmts" style="margin-right:10px;float:right">Editar Senha</a>
          <a href="{{route('editar-bibliotecario')}}" class="btn btn-primary-lmts" style="margin-right:10px;float:right">Editar Informações</a>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

@endsection
