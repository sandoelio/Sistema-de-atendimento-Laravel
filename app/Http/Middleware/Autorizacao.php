<?php

namespace App\Http\Middleware;
use Closure;


class Autorizacao
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //  TODO dar um novo nome a variavel de usuário para não conflitar com a variavel
        //  do Cognitivo
        //  Destruir essa variavel no Logout
        //$t = new \Symfony\Component\HttpFoundation\Session\Session()
        $liberado =  $request->session()->has("pessoa_id");
        if (!$liberado) {
            //echo "passou no Meedle";
            return redirect("/login");
        }
        return $next($request);
    }

}
