<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibliotecarioController extends Controller
{
    // Redireciona para tela de login ao entrar no sistema
  public function index()
  {
    // return view('autenticacao.home-aluno');
    if(Auth::user()){
      return redirect()->route('home');
    }
    return view('autenticacao.login');
  }

  public function createBibliotecario()
  {
    return view('autenticacao.cadastro-bibliotecario');
  }
}
