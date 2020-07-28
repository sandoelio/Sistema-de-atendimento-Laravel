<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LoginController extends Controller{


    public function limpar_cache(){
        //$exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
        //file_put_contents(storage_path() ."/teste.csv", "Emerson ddddd Santanna");
        $file = storage_path(). '/teste.csv';
        //return "teste: ". $exitCode;
        return Response()->download($file);

    }
    
    public function index(Request $request){

        $logado = $request->session()->get('usuario_id',0);
        return view('login.login');

    }

    public function logout(Request $request){
        
        $request->session()->forget("pessoa_id");
        $request->session()->forget("empresa_id");
        return redirect("/");
    }

    public function loginValidate(Request $request){

        $usuario = \App\Pessoa::where("email", trim($request->input("email") ))->where("ativo","1")->first();

        $pessoa_log = new \App\PessoaLog();
        $pessoa_log->data_evento  = date("Y-m-d H:i:s");
        $pessoa_log->ip_endereco = $request->ip();
        $pessoa_log->login = $request->input("email");
        
        
        if($usuario){

            $pessoa_log->pessoa_id = $usuario->id;
            
            if($usuario->senha == trim($request->input("senha"))){
                
                
                $pessoa_log->observacao = "Sucesso";
                $pessoa_log->save();
                
                $request->session()->put('pessoa_id', $usuario->id);
                $request->session()->put('pessoa_perfil_id', $usuario->pessoa_perfil_id);
                $request->session()->put('empresa_id', $usuario->empresa_id);
                
            }else{
                
                    $pessoa_log->senha = $request->input("senha");
                    $pessoa_log->observacao = "Falha";
                    $pessoa_log->save();

                    $request->session()->clear();
                
            }

            return redirect("/");

            
        }else{

            $pessoa_log->senha = $request->input("senha");
            $pessoa_log->observacao = "Falha";
            $pessoa_log->save();
            
            $request->session()->clear();
            return redirect("/login");
        }

    }
    
    
}