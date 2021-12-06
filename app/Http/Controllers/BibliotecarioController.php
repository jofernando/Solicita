<?php

namespace App\Http\Controllers;

use App\Models\Bibliotecario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

  public function perfil()
  {
    $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
    $bibliotecario = Bibliotecario::where('user_id',$idUser)->first(); //Bibliotecario autenticado
    return view('telas_bibliotecario.perfil_bibliotecario', ['user'=>$user,
    'bibliotecario'=>$bibliotecario]);
    
  }

  public function storeBibliotecario(Request $request) {
    $request->validate([
      'name' => 'required|string|max:255',
      'matricula' => 'required|unique:bibliotecarios|numeric|digits_between:1,10',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);
    $usuario = new User();
    $usuario->name = $request->input('name');
    $usuario->email = $request->input('email');
    $usuario->password = Hash::make($request->input('password'));
    $usuario->tipo = 'bibliotecario';
    $usuario->save();
  //INSTANCIA DO BIBLIOTECARIO
    $bibliotecario = new Bibliotecario();
    $bibliotecario->matricula = $request->input('matricula');
    $bibliotecario->user_id = $usuario->id;
    $bibliotecario->save();
    $usuario->sendEmailVerificationNotification();
    return redirect()->route('home')->with('success', 'Bibliotecario cadastrado com sucesso!');
  }

  public function editarBibliotecario(){
    $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
    $bibliotecario = Bibliotecario::where('user_id',$idUser)->first(); //Bibliotecario autenticado
    return view('telas_bibliotecario.editar_bibliotecario', ['user'=>$user,
    'bibliotecario'=>$bibliotecario]);
  }
  public function atualizarBibliotecario(Request $request){
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
    return redirect()->route('home-bibliotecario')
                                            ->with('success', 'Seus dados foram atualizados!');
  }

  public function editarSenha(){
    return view('telas_bibliotecario.alterar_senha_bibliotecario');
  }
  public function atualizarSenha(Request $request){
    if (!Hash::check($request->atual, Auth::user()->password)) {
      return redirect()->back()->with('error', 'Senha atual está incorreta');
    }
    $request->validate([
      'password' => 'required|string|min:8|confirmed',
      // 'atual' => 'required|string|min:8',
    ]);
    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect()->route('perfil-bibliotecario')
                                            ->with('success', 'Senha alterada com sucesso!');

  }

}


