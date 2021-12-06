@extends('layouts.app')
@section('conteudo')

@section('titulo','Home Bibliotecario')

@section('navbar')
    Home
@endsection
<div class="container" style="min-height:70vh">
   <div>@include('componentes.mensagens')</div>

   <div class="row justify-content-center d-flex align-items-center">
      <div class="col-sm-4 d-flex justify-content-center">
         <a href="#" style="text-decoration:none; color: inherit;">
            <div class="card cartao text-center " style="border-radius: 30px">
             <div class="card-body d-flex justify-content-center">
                  <h2 style="padding-top:15px">Listar Documentos Solicitados</h2>
               </div>
            </div>
         </a>
      </div>
   </div>

</div>
@endsection
