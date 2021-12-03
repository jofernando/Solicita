<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBibliotecario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/')->with('error', 'É necessário estar logado para utilizar esta funcionalidade');
          }
          if(Auth::user()->tipo=='bibliotecario'){
            return $next($request);
          }
          else{
            return redirect('home')->with('error', 'Você não possui privilégios para acessar esta funcionalidade');
          }
    }
}
