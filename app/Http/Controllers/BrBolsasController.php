<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BrBolsasController extends Controller{


    public function index(Request $request){

        $request->session()->forget("opcao_1");
        $request->session()->forget("opcao_2");
        $request->session()->forget("opcao_3");

        $cursos = \App\Curso::where("ativo",1)->orderBy("nome","asc")->get();
        
        return view('brbolsas.index', compact('cursos'));

    }

    public function curso(Request $request , $curso_id){

        $opcao_1 = $request->session()->get('opcao_1',"0");
        $opcao_2 = $request->session()->get('opcao_2',"0");
        $opcao_3  = $request->session()->get('opcao_3',"0");

        $cursos_id_retirar = array($opcao_1 , $opcao_2 , $opcao_3);
        $cursos = \App\Curso::where("ativo",1)->whereNotIn("id" , $cursos_id_retirar)->orderBy("nome","asc")->get();
        
        return view("brbolsas." . $curso_id , compact('cursos','curso_id'));

    }
    
    
    public function save(Request $request){
        
        $opcao = $request->input("opcao");
        $curso_id = $request->input("curso_id");
        
        if($opcao  == 1){
            
            $request->session()->put('opcao_1',$curso_id);
            
        }elseif ($opcao  == 2) {

            $request->session()->put('opcao_2',$curso_id);
            
        }elseif ($opcao  == 3) {
            
            $request->session()->put('opcao_3',$curso_id);
            
        }
        
        $fim = 0;
        
        if($opcao  == 3){

            $sessao = uniqid();
            $curso_preferido = new \App\CursoPreferido();
            $curso_preferido->data_registro = date("Y-m-d H:i:s");
            $curso_preferido->ordem_escolha = 1;
            $curso_preferido->curso_id = $request->session()->get('opcao_1');
            $curso_preferido->sessao = $sessao;
            $curso_preferido->save();
            
            $curso_preferido = new \App\CursoPreferido();
            $curso_preferido->data_registro = date("Y-m-d H:i:s");
            $curso_preferido->ordem_escolha = 2;
            $curso_preferido->curso_id = $request->session()->get('opcao_2');
            $curso_preferido->sessao = $sessao;
            $curso_preferido->save();
            
            $curso_preferido = new \App\CursoPreferido();
            $curso_preferido->data_registro = date("Y-m-d H:i:s");
            $curso_preferido->ordem_escolha = 3;
            $curso_preferido->curso_id = $request->session()->get('opcao_3');
            $curso_preferido->sessao = $sessao;
            $curso_preferido->save();
            
            $fim = 1;
            
        }
        
        return array("erro"=>0, "mensagem"=>"Grvação realizada com sucesso","fim"=> $fim);
        
    }
    
    public function ativar(Request $request , $local_id, $ativo){
        
        $local = \App\Local::find($local_id);
        $local->ativo = $ativo;
        $local->save();
        
        return array("erro"=>0, "mensagem"=>"Grvação realizada com sucesso");
        
    }
    
    public function update(Request $request){
        
        $local = \App\Local::find($request->input("id"));
        $local->descricao = $request->input("descricao");
        $local->save();
        
        return array("erro"=>0, "mensagem"=>"Atualização realizada com sucesso");
        
    }

    public function create(Request $request){
        
        return view('local.create');

    }

    public function edit(Request $request, $id){

        $local = \App\Local::find($id);
        
        return view('local.edit', compact('local'));

    }
    
    
}