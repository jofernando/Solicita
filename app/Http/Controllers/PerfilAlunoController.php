<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Curso;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Perfil;
use App\Models\Requisicao;
use App\Models\Requisicao_documento;
use Auth;

class PerfilAlunoController extends Controller
{
    //
    public function index(){
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado

      //PRIMEIRO PERFIL DO ALUNO
      $perfil = Perfil::where([['aluno_id',$aluno->id], ['valor', true]])->first();

      //TODOS OS PERFIS VINCULADOS AO ALUNO
      $perfisAluno = Perfil::where('aluno_id',$aluno->id)->get();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return view('telas_aluno.perfil_aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno,'perfisAluno'=>$perfisAluno]);
    }
    public function editarInfo(){
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      return view('telas_aluno.editar_info_aluno',compact('user','aluno'));
    }
    public function storeEditarInfo(Request $request){
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
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return redirect()->route('home-aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno])
                                              ->with('success', 'Seus dados foram atualizados!');
    }
    public function alterarSenha(){
      return view('telas_aluno.alterar_senha');
    }
    public function storeAlterarSenha(Request $request){
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
      $cursos = Curso::all();
      $unidades = Unidade::all();
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      return redirect()->route('perfil-aluno',['cursos'=>$cursos,'unidades'=>$unidades,'user'=>$user,
                                              'aluno'=>$aluno,'perfil'=>$perfil,'unidadeAluno'=>$unidadeAluno->nome,'cursoAluno'=>$cursoAluno])
                                              ->with('success', 'Senha alterada com sucesso!');

    }
    public function adicionaPerfil(Request $request){
      $idUser = Auth::user()->id;
      $user = User::find($idUser); //Usuário Autenticado
      $aluno = Aluno::where('user_id',$idUser)->first(); //Aluno autenticado
      $perfil = Perfil::where('aluno_id',$aluno->id)->first();
      $unidadeAluno = Unidade::where('id',$perfil->unidade_id)->first();
      $cursoAluno = Curso::where('id',$perfil->curso_id)->first();
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();
      $id = [];
      foreach ($perfis as $perfil) {
        array_push($id, $perfil->curso_id);
      }
      $cursos = Curso::whereNotIn('id', $id)->get();
      $unidades = Unidade::All();
      $quant = count($perfis);
      if($quant==7){
        return redirect()->back()
        ->with('error', 'Você já possui todos os cursos adicionados ao seus perfil, caso queira atualizar o status do seu vínculo,
        favor excluir o curso em questão e adicionar perfil com o novo vínculo');
      }
      else{
      return view ('telas_aluno.adiciona_perfil_aluno', compact('perfil', 'perfis','cursoAluno', 'unidadeAluno', 'aluno', 'unidades', 'cursos'));
      }
    }
  public function salvaPerfil(Request $request){
  $usuario = User::find(Auth::user()->id);
  $aluno = $usuario->aluno;

  $perfil = new Perfil();
  $perfil->curso_id = $request->curso;
  $perfil->unidade_id = $request->unidade;
        $vinculo = $request->vinculo;
        if($vinculo==="1"){
          $perfil->situacao = "Matriculado";
        }else if ($vinculo==="2"){
          $perfil->situacao = "Egresso";
        }
        else if ($vinculo==="3"){
          $perfil->situacao = "Especial";
        }
        else if ($vinculo==="4"){
          $perfil->situacao = "REMT - Regime Especial de Movimentação Temporária";
        }
        else if ($vinculo==="5"){
          $perfil->situacao = "Desistente";
        }
        else if ($vinculo==="6"){
          $perfil->situacao = "Trancado";
        }
        else if ($vinculo==="7"){
          $perfil->situacao = "Intercâmbio";
        }
        $definicaoPadrao = $request->selecaoPadrao;
        if($definicaoPadrao=='true'){
          $perfis = Perfil::where('aluno_id',$aluno->id)->get();
          foreach ($perfis as $p) {
            $p->valor = false;
            $p->save();
          }
          $perfil->valor=true;
        }
        else{
        $perfil->valor = false;
      }
      $temp = $request->cursos;
      $curso = Curso::where('id',$request->curso)->first();
      $perfil->default = $curso->nome;
      $perfil->aluno()->associate($aluno);
      $perfil->save();
      // }
  // return redirect ('/perfil-aluno');
  return redirect()->route('perfil-aluno')->with('success', 'Perfil adicionado com sucesso!');
}
public function excluirPerfil(Request $request) {


      if($request->idPerfil==null){
        return redirect()->back()->with('error', 'Selecione o perfil que deseja excluir');
      }
      $usuario = User::find(Auth::user()->id);
      $aluno = $usuario->aluno;
      $perfis = Perfil::where('aluno_id',$aluno->id)->get();


      $quant = count($perfis);
      if($quant===1){
        return redirect()->back()->with('error', 'Necessário haver ao menos um perfil vinculado ao aluno!');
      }
      else{
        // Requisições do perfil selecionado para deletar
        $requisicoes = Requisicao::where('perfil_id',$request->idPerfil)->get();
        foreach ($requisicoes as $requisicao) {

          $requisicao_documento = Requisicao_Documento::where('requisicao_id',$requisicao->id)->get();
          foreach ($requisicao_documento as $rd) {
            if($rd->status == "Em andamento"){
              return redirect()->back()->with('error', 'Você não pode excluir este perfil pois existem requisições em andamento vinculadas a ele.');
            }
          }
        }

        $id = $request->idPerfil;
        $isDefault = Perfil::where('id',$id)->first();
        // Perfil Default
        if ($isDefault->valor==true) {
          // $perfil = Perfil::where('id', $id)->delete();
          $perfil = Perfil::find($id);
          $requisicoes = Requisicao::where('perfil_id',$perfil->id)->get();
          // dd($requisicoes);
          foreach ($requisicoes as $requisicao){
            $requisicao_documento = Requisicao_documento::where('requisicao_id',$requisicao->id)->where('status','not like','Em andamento');
            if(isset($requisicao_documento)){
              // dd($requisicao_documento);
              $requisicao_documento->delete();
              $requisicao->delete();
            }
          }
          $perfil->delete();
          // dd($perfil);
          $primeiro = Perfil::where('aluno_id', $aluno->id)->first();
          $primeiro->valor=true;
          $primeiro->save();
          return redirect()->back()->with('success', 'Deletado com Sucesso!');
        }
        // Perfil Secundário
        else{
          // $perfil = Perfil::where('id', $id)->delete();
          $perfil = Perfil::find($id);
          $requisicoes = Requisicao::where('perfil_id',$perfil->id)->get();
          // dd($requisicoes);
          foreach ($requisicoes as $requisicao){
            $requisicao_documento = Requisicao_documento::where('requisicao_id',$requisicao->id)->where('status','not like','Em andamento');
            // dd($requisicao_documento);
            if(isset($requisicao_documento)){
              $requisicao_documento->delete();
              $requisicao->delete();

            }
          }
          $perfil->delete();

          // dd($perfil);
        }
        return redirect()->back()->with('success', 'Deletado com Sucesso!');
      }
}
public function definirPerfilDefault(Request $request){
    $id = $request->idPerfil;
    $selecao = Perfil::where('id', $id)->first(); //perfil que será selecionado como padrão
    // dd($selecao);
    $usuario = User::find(Auth::user()->id);

    $aluno = $usuario->aluno;
    $perfis = Perfil::where('aluno_id',$aluno->id)->get();
    // dd($perfis);
    foreach ($perfis as $p) {
      if($p->id == $selecao->id){
        // dd("Achei");
        $p->valor = true;
        $p->save();
      }else{
        $p->valor = false;
        $p->save();
      }
    }
    return redirect()->back()->with('success', 'Definido com sucesso!');
  }
}
