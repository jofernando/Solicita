<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//----------------------------------------------USUARIO----------------------------------------------------------------
Route::get('/', [\App\Http\Controllers\AlunoController::class,'index'])->name('login');
Auth::routes(['verify' => true]);

// ---------------------------------------------ALUNO-------------------------------------------------------------------
Route::get('/cadastro',[\App\Http\Controllers\AlunoController::class,'createAluno'])->name('cadastro');
Route::post('/cadastro',[\App\Http\Controllers\AlunoController::class,'storeAluno'])->name('cadastro');

//----------------------------------------------ADMINISTRADOR-----------------------------------------------------------
Route::group(['middleware'=> ['CheckAdministrador', 'verified']], function(){
    Route::get('/home-administrador',[\App\Http\Controllers\AdministradorController::class, 'index'])->name('home-administrador')->middleware('CheckAdministrador');
    Route::get('/cadastro-servidor',[\App\Http\Controllers\ServidorController::class, 'homeServidor'])->name('cadastro-servidor')->middleware('CheckAdministrador');
    Route::post('/confirmacao-servidor',[\App\Http\Controllers\ServidorController::class, 'storeServidor'])->name('confirmacao-servidor')->middleware('CheckAdministrador');
    Route::get('/cancela-cadastro',[\App\Http\Controllers\ServidorController::class, 'cancel'])->name('cancela-cadastro')->middleware('CheckAdministrador');
    Route::get('/cadastro-biblioteca',[\App\Http\Controllers\BibliotecaController::class,'createBiblioteca'])->name('cadastro-biblioteca');
    Route::post('/criar-biblioteca',[\App\Http\Controllers\BibliotecaController::class,'storeBiblioteca'])->name('criar-biblioteca');
    Route::get('/cadastro-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class,'createBibliotecario'])->name('cadastro-bibliotecario');
    Route::post('/criar-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class,'storeBibliotecario'])->name('criar-bibliotecario');
    Route::get('/editar-biblioteca',[\App\Http\Controllers\BibliotecaController::class,'editarBiblioteca'])->name('editar-biblioteca');
    Route::post('/editar-biblioteca',[\App\Http\Controllers\BibliotecaController::class,'atualizarBiblioteca'])->name('atualizar-biblioteca');
    Route::get('/listar-biblioteca',[\App\Http\Controllers\BibliotecaController::class,'listarBiblioteca'])->name('listar-biblioteca');
});

//----------------------------------------------SERVIDOR----------------------------------------------------------------
Route::group(['middleware'=> ['CheckServidor', 'verified']], function(){

    // Route::post('/filtrar-requisicoes/{curso_id?}', 'RequisicaoController@filtrarCurso')->name('filtrar-requisicoes-post')->middleware('CheckServidor');

    Route::post('/indefere-requisicoes/{requisicao_id?}', [\App\Http\Controllers\RequisicaoController::class, 'indeferirRequisicao'])->name('indefere-requisicoes-post')->middleware('CheckServidor');
    Route::get('/listar-requisicoes', [\App\Http\Controllers\RequisicaoController::class, 'getRequisicoes'])->name('listar-requisicoes')->middleware('CheckServidor');
    Route::get('/relatorio-requisicoes',[\App\Http\Controllers\RequisicaoController::class, 'exibirBusca'])->name('relatorio-requisicoes')->middleware('CheckServidor');
    Route::get('/listar-requisicoes-aluno-servidor/{id}',[\App\Http\Controllers\RequisicaoController::class, 'listarRequisicoes'])->name('listar-requisicoes-servidor')->middleware('CheckServidor');
    Route::post('/relatorio-requisicoes',[\App\Http\Controllers\RequisicaoController::class, 'gerarRelatorio'])->name('listar-relatorio-post')->middleware('CheckServidor');
    Route::get('/pesquisar-aluno',[\App\Http\Controllers\RequisicaoController::class, 'exibirPesquisa'])->name('pesquisar-aluno')->middleware('CheckServidor');
    Route::post('/pesquisar-aluno',[\App\Http\Controllers\RequisicaoController::class, 'pesquisarAluno'])->name('pesquisar-aluno-post')->middleware('CheckServidor');
    Route::post('/listar-requisicoes',[\App\Http\Controllers\RequisicaoController::class, 'concluirRequisicao'])->name('listar-requisicoes-post')->middleware('CheckServidor');
    Route::get('/home-servidor',[\App\Http\Controllers\ServidorController::class, 'index'])->name('home_servidor')->middleware('CheckServidor');
    Route::get('/home-servidor',[\App\Http\Controllers\RequisicaoController::class, 'index'])->name('cadastro-servidor')->middleware('CheckServidor');
    Route::post('/novo-servidor',[\App\Http\Controllers\RequisicaoController::class, 'storeServidor'])->name('novo-servidor')->middleware('CheckServidor');
    Route::get('/alterar-senha-servidor',[\App\Http\Controllers\RequisicaoController::class, 'alterarSenhaServidor'])->name('alterar-senha-servidor')->middleware('CheckServidor');
    Route::post('/alterar-senha-servidor',[\App\Http\Controllers\RequisicaoController::class, 'storeAlterarSenhaServidor'])->name('alterar-senha-servidor')->middleware('CheckServidor');
    Route::get('/home-servidor',[\App\Http\Controllers\RequisicaoController::class, 'index'])->name('home_servidor')->middleware('CheckServidor');
});
//----------------------------------------------ALUNO---------------------------------------------------
// Route::group(['middleware'=> 'verified'], function(){
Route::group(['middleware'=> 'CheckAluno'], function(){
    Route::get('/home-aluno', [\App\Http\Controllers\AlunoController::class, 'index'])->name('home-aluno')->middleware('CheckAluno');
    Route::get('/home-aluno',[\App\Http\Controllers\AlunoController::class, 'homeAluno'])->name('home-aluno')->middleware('CheckAluno');
    Route::get('/listar-requisicoes-aluno',[\App\Http\Controllers\AlunoController::class, 'listarRequisicoes'])->name('listar-requisicoes-aluno')->middleware('CheckAluno');
    Route::post('/confirmacao-requisicao', [\App\Http\Controllers\RequisicaoController::class, 'novaRequisicao'])->name('confirmacao-requisicao')->middleware('CheckAluno'); //------------
    Route::post('/finaliza-requisicao', [\App\Http\Controllers\RequisicaoController::class, 'finalizaRequisicao'])->name('finaliza-requisicao')->middleware('CheckAluno');
    Route::get('/cancela-requisicao', [\App\Http\Controllers\RequisicaoController::class, 'cancelaRequisicao'])->name('cancela-requisicao')->middleware('CheckAluno');
    Route::get('/prepara-requisicao', [\App\Http\Controllers\RequisicaoController::class, 'preparaNovaRequisicao'])->name('prepara-requisicao')->middleware('CheckAluno');
    Route::post('/excluir-requisicao/{id}',[\App\Http\Controllers\RequisicaoController::class, 'excluirRequisicao'])->name('excluir-requisicao');
    Route::get('/confirmacao-requisicao',function(){
        return view('autenticacao.confirmacao-requisicao');
    })->name('confirmacao-requisicao')->middleware('CheckAluno');
    Route::get('/perfil-aluno',[\App\Http\Controllers\PerfilAlunoController::class, 'index'])->name('perfil-aluno')->middleware('CheckAluno');
    Route::get('/editar-perfil',[\App\Http\Controllers\PerfilAlunoController::class, 'editarInfo'])->name('editar-info')->middleware('CheckAluno');
    Route::get('/exibir-perfil-aluno',[\App\Http\Controllers\PerfilAlunoController::class, 'editarInfo'])->name('exibir-perfil-aluno')->middleware('CheckAluno');
    Route::post('/editar-perfil',[\App\Http\Controllers\PerfilAlunoController::class, 'storeEditarInfo'])->name('editar-info')->middleware('CheckAluno');
    Route::post('/excluir-perfil{idPerfil?}',[\App\Http\Controllers\PerfilAlunoController::class, 'excluirPerfil'])->name('excluir-perfil')->middleware('CheckAluno');
    Route::post('/perfil-padrao{idPerfilPadrao?}',[\App\Http\Controllers\PerfilAlunoController::class, 'definirPerfilDefault'])->name('perfil-padrao')->middleware('CheckAluno');
    Route::get('/adiciona-perfil', [\App\Http\Controllers\PerfilAlunoController::class, 'adicionaPerfil'])->name('adiciona-perfil')->middleware('CheckAluno');
    Route::post('/salva-novo-perfil-aluno', [\App\Http\Controllers\PerfilAlunoController::class, 'salvaPerfil'])->name('salva-novo-perfil-aluno')->middleware('CheckAluno');
    Route::post('/salva-novo-perfil-aluno', [\App\Http\Controllers\PerfilAlunoController::class, 'salvaPerfil'])->name('salva-novo-perfil-aluno')->middleware('CheckAluno');
    Route::get('/alterar-senha',[\App\Http\Controllers\PerfilAlunoController::class, 'alterarSenha'])->name('alterar-senha')->middleware('CheckAluno');
    Route::post('/alterar-senha',[\App\Http\Controllers\PerfilAlunoController::class, 'storeAlterarSenha'])->name('alterar-senha')->middleware('CheckAluno');
    Route::get('/formulario-requisicao',[\App\Http\Controllers\RequisicaoController::class, 'index'])->name('formulario-requisicao')->middleware('CheckAluno');
    Route::post('/formulario-requisicao',[\App\Http\Controllers\RequisicaoController::class, 'storeRequisicao'])->name('formulario-requisicao-post')->middleware('CheckAluno');
});

//----------------------------------------------BIBLIOTECARIO---------------------------------------------------
// Route::group(['middleware'=> 'verified'], function(){
Route::group(['middleware'=> 'CheckBibliotecario'], function(){
    Route::get('/home-bibliotecario', [\App\Http\Controllers\BibliotecarioController::class, 'index'])->name('home-bibliotecario')->middleware('CheckBibliotecario');
    Route::get('/perfil-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class, 'perfil'])->name('perfil-bibliotecario')->middleware('CheckBibliotecario');
    Route::get('/editar-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class, 'editarBibliotecario'])->name('editar-bibliotecario')->middleware('CheckBibliotecario');
    Route::post('/atualizar-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class, 'atualizarBibliotecario'])->name('atualizar-bibliotecario')->middleware('CheckBibliotecario');
    Route::get('/editar-senha-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class, 'editarSenha'])->name('editar-senha-bibliotecario')->middleware('CheckBibliotecario');
    Route::post('/atualizar-senha-bibliotecario',[\App\Http\Controllers\BibliotecarioController::class, 'atualizarSenha'])->name('atualizar-senha-bibliotecario')->middleware('CheckBibliotecario');
});

//----------------------------------------------BIBLIOTECA---------------------------------------------------
Route::group(['middleware'=> 'CheckBiblioteca'], function(){
    Route::get('/home-bibliotecario', [\App\Http\Controllers\BibliotecarioController::class, 'index'])->name('home-bibliotecario')->middleware('CheckBibliotecario');
});

// });
// ---------------------------------------REQUISICAO------------------------------------------------------------------
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
// Route::get('/mail-send', 'MailController@send');

// Route::get('/edita-perfil','PerfilController@editaPerfil')->name('edita-perfil');
// Route::get('/adiciona-perfil', 'PerfilController@adicionaPerfil')->name('adiciona-perfil');//SUPRIMIR
// Route::post('/excluir-perfil',[\App\Http\Controllers\PerfilAlunoController::class, 'excluirPerfil')->name('excluir-perfil');
// Route::get('/', 'UsuarioController@index')->name('login');
// Route::post('/confirmacao-requisicao', [\App\Http\Controllers\AlunoController::class, 'novaRequisicao')->name('confirmacao-requisicao'); //------------
// Route::post('/finaliza-requisicao', [\App\Http\Controllers\AlunoController::class, 'finalizaRequisicao')->name('finaliza-requisicao');
// Route::get('/cancela-requisicao', [\App\Http\Controllers\AlunoController::class, 'cancelaRequisicao')->name('cancela-requisicao');
// Route::get('/prepara-requisicao', [\App\Http\Controllers\AlunoController::class, 'preparaNovaRequisicao')->name('prepara-requisicao');
// Route::post('/excluir-perfil',[\App\Http\Controllers\PerfilAlunoController::class, 'excluirPerfil')->name('excluir-perfil');

