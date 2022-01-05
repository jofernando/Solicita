<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Curso;
use App\Models\User;
use App\Models\Servidor;
use App\Models\Unidade;

use App\Models\Aluno;
use App\Models\Perfil;
use App\Models\Requisicao;
use App\Models\Documento;
use App\Models\Requisicao_documento;
use Auth;

class ServidorController extends Controller
    {
    public function index(){
        $cursos = Curso::all();
        $tipoDocumento = ['Declaração de Vínculo','Comprovante de Matrícula','Histórico','Programa de Disciplina','Outros','Concluidos', 'Indeferidos'];
        return view('telas_servidor.home_servidor', ['cursos'=>$cursos,'tipoDocumento'=>$tipoDocumento]);
    }
    public function listarRequisicoes($id){
      $idUser=$id;
      $aluno = Aluno::where('user_id',$idUser)->first();
      //ordena pela data e hora do pedido
      // $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('data_pedido','desc')->orderBy('hora_pedido', 'desc')->get();
      $requisicoes = Requisicao::where('aluno_id',$aluno->id)->orderBy('id','desc')->get();
      $requisicoes_documentos = Requisicao_documento::where('aluno_id',$aluno->id)->get();
      $aluno= Aluno::where('user_id',$idUser)->first();
      $documentos = Documento::all();
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      return view('telas_servidor.requisicoes_aluno_servidor',compact('requisicoes','requisicoes_documentos','aluno','documentos','perfis'));
    }


    public function storeServidor(Request $request) {
      $request->validate([
        'name' => 'required|string|max:255',
        'matricula' => 'required|unique:servidors|numeric|digits_between:1,10',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
      ]);
      $usuario = new User();
      $usuario->name = $request->input('name');
      $usuario->email = $request->input('email');
      $usuario->password = Hash::make($request->input('password'));
      $usuario->tipo = 'servidor';
      $usuario->save();
    //INSTANCIA DO SERVIDOR
      $servidor = new Servidor();
      $servidor->matricula = $request->input('matricula');
      $servidor->unidade_id = 1;
      $servidor->user_id = $usuario->id;
      $servidor->save();
      $usuario->sendEmailVerificationNotification();
      return redirect()->route('home')->with('success', 'Servidor cadastrado com sucesso!');
    }
    public function listaServidores(){
          return view('/autenticacao.home-administrador'); //redireciona para view
    }
    public function cancel(){
          return view('/'); //redireciona para view
    }
    public function homeServidor(){
    $unidades = Unidade::All();
    $users = User::All();
    return view('autenticacao.cadastro-servidor',compact('users','unidades'));
    }

    public function alterarSenhaServidor(){
      $user = Auth::user();
      return view('telas_servidor.alterar_senha_server', compact('user'));
    }
    public function storeAlterarSenhaServidor(Request $request){
      if (!Hash::check($request->atual, Auth::user()->password)) {
        return redirect()->back()->with('error', 'Senha atual está incorreta');
      }
      $request->validate([
        'password' => 'required|string|min:8|confirmed',
      ]);
      $user = Auth::user();
      $user->password = Hash::make($request->password);
      $user->save();
      return redirect()->route('home')->with('success', 'Senha alterada com sucesso!');
    }

  }
