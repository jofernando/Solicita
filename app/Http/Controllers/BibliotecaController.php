<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BibliotecaController extends Controller
{
     // Redireciona para tela de login ao entrar no sistema
  public function index()
  {
    //return view('biblioteca.listar');
  }

  public function createBiblioteca()
  {
    return view('telas_biblioteca.cadastro-biblioteca');
  }


  public function storeBiblioteca(Request $request) {
    $request->validate([
      'nome' => 'required|string|max:255',
    ]);
    $biblioteca = new Biblioteca();
    $biblioteca->nome = $request->nome;
    $biblioteca->save();
    return redirect()->route('home')->with('success', 'Biblioteca cadastrada com sucesso!');
  }

  public function editarBiblioteca(Request $request){
      $biblioteca = Biblioteca::find($request->id_biblioteca);
    return view('telas_biblioteca.editar-biblioteca', ['biblioteca'=>$biblioteca]);
  }
  public function atualizarBiblioteca(Request $request){
      $biblioteca = Biblioteca::find($request->id_biblioteca);
    $request->validate(['nome' => ['required'],
      ]);
    $biblioteca->nome = $request->nome;
    $biblioteca->save();
    return redirect()->route('listar-biblioteca')
                                            ->with('success', 'A biblioteca foi atualizada!');
  }

    public function listarBiblioteca(){
        $biblioteca = Biblioteca::all(); //Bibliotecario autenticado
        return view('telas_biblioteca.listar-bibliotecas', ['bibliotecas'=>$biblioteca]);
    }

}
