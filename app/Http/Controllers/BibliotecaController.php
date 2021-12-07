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
    // return view('autenticacao.home-aluno');
    if(Auth::user()){
      return redirect()->route('home');
    }
    return view('autenticacao.login');
  }

  public function createBiblioteca()
  {
    return view('autenticacao.cadastro-biblioteca');
  }


  public function storeBiblioteca(Request $request) {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
    ]);
    $usuario = new User();
    $usuario->name = $request->input('name');
    $usuario->email = $request->input('email');
    $usuario->tipo = 'biblioteca';
    $usuario->save();
  //INSTANCIA DO BIBLIOTECA
    $biblioteca = new Biblioteca();
    $biblioteca->user_id = $usuario->id;
    $biblioteca->save();
    $usuario->sendEmailVerificationNotification();
    return redirect()->route('home')->with('success', 'Biblioteca cadastrado com sucesso!');
  }

  public function editarBiblioteca(){
    $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
    $biblioteca = Biblioteca::where('user_id',$idUser)->first(); //Bibliotecario autenticado
    return view('telas_biblioteca.editar_biblioteca', ['user'=>$user,
    'biblioteca'=>$biblioteca]);
  }
  public function atualizarBiblioteca(Request $request){
    //atualização dos dados
    $user = Auth::user();
    if($user->email!=$request->email){
      $request->validate([
        'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
      ]);
    }
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();
    //dados para ser exibido na view
    $idUser = Auth::user()->id;
    $user = User::find($idUser); //Usuário Autenticado
    return redirect()->route('/')
                                            ->with('success', 'Seus dados foram atualizados!');
  }


}
