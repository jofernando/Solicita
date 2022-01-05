<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Perfil;
use App\Models\Aluno;
use App\Models\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Config;
// use Illuminate\Support\Facades\URL;
// use App\Mail\EmailVerification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => ['bail','required','unique:alunos'],
            // 'cpf' => ['required','integer','unique:alunos'],
            'vinculo' => ['required'],
            'unidade' => ['required'],
            'cursos' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([ //Criação de usuário, para apenas após a criação ser atribuida a nova variável
                              'name' => $data['name'],
                              'email' => $data['email'],
                              'password' => Hash::make($data['password']),
                              'tipo' => 'aluno',
                           ]);

        $aluno = Aluno::create([
                              'user_id'=>$user->id,
                              'cpf' => $data['cpf'],
                              ]);
        $id = Curso::where('id', $data['cursos'])->first();
        $curso = $id->nome;

        $vinculo = $data['vinculo'];
            if($vinculo==="1"){

              $situacao = "Matriculado";
            }else if ($vinculo==="2"){

              $situacao = "Egresso";
            }
            else if ($vinculo==="3"){

              $situacao = "Especial";
            }
            else if ($vinculo==="4"){
              $situacao = "REMT - Regime Especial de Movimentação Temporária";
            }
            else if ($vinculo==="5"){
              $situacao = "Desistente";
            }
            else if ($vinculo==="6"){
              $situacao = "Trancado";
            }
            else if ($vinculo==="7"){
              $situacao = "Intercâmbio";
            }
        $perfil = Perfil::create([
                            'default' => $curso,
                            'situacao' => $situacao,
                            'valor' =>true,
                            'aluno_id' => $aluno->id,
                            'curso_id' => $data['cursos'],
                            'unidade_id' => $data['unidade'],
                            ]);



        //
        // $verifyUrl = URL::temporarySignedRoute(
        //   'verification.verify',
        //   Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
        //   [
        //       'id' => $user->getKey(),
        //       'hash' => sha1($user->getEmailForVerification()),
        //   ]
        // );
        //
        // $mail = new EmailVerification($verifyUrl, $user);
        //
        // Mail::to($user->email)->send($mail);
        return $user;
    }
}
