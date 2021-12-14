@extends('layouts.app')

@section('conteudo')



  <div class="tabela-centro mx-auto" >

      <div class="row" style="margin-top: 20px">
          <div class="col-md-8">
              <h2 class="mt-1" > Lista de Bibliotecas</h2>
          </div>
          <div class="col-md-4">
              <a class="btn btn-primary" href="{{ route("cadastro-biblioteca") }}" style="float:right; color: white" >Cadastrar Biblioteca</a>
          </div>
      </div>

      <table class="table table-hover" style=" background-color:#1B2E4F; color: white ">
          <thead>
          <tr>
              <th scope="col">Nome</th>
              <th scope="col" style="width: 30%">Ações</th>
          </tr>
          </thead>
          <tbody>
          @foreach($bibliotecas as $biblioteca)
              <tr>
                  <td>{{ $biblioteca->nome }}</td>
                  <td><a href="{{ route('editar-biblioteca',["id_biblioteca" => $biblioteca->id]) }}">EDITAR</a></td>
              </tr>
          @endforeach

          </tbody>
      </table>

  </div>

@endsection
