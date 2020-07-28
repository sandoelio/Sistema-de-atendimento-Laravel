<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Pessoa;
use App\AulaAvaliacao;
use App\AulaAvaliacaoQuesito;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProblemaController extends Controller{


    public function index(Request $request){
        
        $problemas = \App\Problema::where("ativo",1)->where("publico",1)->orderBy("descricao","asc")->get();
        
        return view('problema.problema', compact('problemas'));

    }

    public function lista(Request $request){
        
        $sql = "select s.id , solicitante , solicitante_email, solicitante_matricula, DATE_FORMAT(s.data_lancamento,'%d-%m-%Y às %H:%i') as data_lancamento, situacao.descricao as situacao_descricao, p.descricao from sinistro as s 
                        left join sinistro_problema as sp on (s.id = sp.sinistro_id)
                        inner join atendimento_situacao as situacao on ( situacao.id = sp.atendimento_situacao_id  )
                        inner join problema as p on (p.id = sp.problema_id)
                        where sp.atendimento_situacao_id in (1,2,3)
                        order by s.data_lancamento desc
                ";

        $chamados = DB::select($sql,array());
        
        return view('problema.index', compact('chamados'));

    }
    
    public function detalhes_save(Request $request){

        $descricao = trim($request->input("descricao"));
        
        $sinistro_id = $request->input("sinistro_id");
        $sinistro_problema = \App\SinistroProblema::where("id",$request->input("sinistro_problema_id"))->first();
        $sinistro_problema->atendimento_situacao_id = $request->input("atendimento_situacao_id");
        $sinistro_problema->save();
        
        $sinistro_historico = new \App\SinistroHistorico();
        $sinistro_historico->ip = $request->ip();
        $sinistro_historico->sinistro_id = $sinistro_id;
        $sinistro_historico->data_ocorrencia = date("Y-m-d H:i:s");
        $sinistro_historico->atendimento_situacao_id = $request->input("atendimento_situacao_id");
        $sinistro_historico->pessoa_id = $request->session()->get('pessoa_id');
        $sinistro_historico->descricao = $descricao;
        $sinistro_historico->save();
        
        return array("erro"=>0, "mensagem"=>"Solicitação realizada com sucesso","sinistro_id" => $sinistro_id);
        
        
    }    
    
    public function detalhes(Request $request , $sinistro_id){
    
        $chamados = DB::table('sinistro')
        ->join('sinistro_problema', 'sinistro.id', '=', 'sinistro_problema.sinistro_id')
        ->join('atendimento_situacao', 'atendimento_situacao.id', '=', 'sinistro_problema.atendimento_situacao_id')
        ->join('problema', 'problema.id', '=', 'sinistro_problema.problema_id')
        ->select("sinistro_problema.id", "solicitante" , "solicitante_email", "solicitante_matricula", DB::raw("DATE_FORMAT(sinistro.data_lancamento,'%d-%m-%Y às %H:%i') as data_lancamento"), "atendimento_situacao.descricao as situacao_descricao", "problema.descricao","sinistro.descricao as sinistro_descricao")
        ->where("sinistro.id",$sinistro_id)->limit(1)->get();
        
        
        $historicos = DB::table('sinistro')
        ->join('sinistro_problema', 'sinistro.id', '=', 'sinistro_problema.sinistro_id')
        ->join('sinistro_historico', 'sinistro.id', '=', 'sinistro_historico.sinistro_id')
        ->join('atendimento_situacao', 'atendimento_situacao.id', '=', 'sinistro_problema.atendimento_situacao_id')
        ->join('pessoa', 'pessoa.id', '=', 'sinistro_historico.pessoa_id')
        ->select( DB::raw("DATE_FORMAT(sinistro_historico.data_ocorrencia,'%d-%m-%Y às %H:%i') as data_ocorrencia"), "pessoa.nome", "atendimento_situacao.descricao as situacao","sinistro_historico.descricao as historico")
        ->where("sinistro.id",$sinistro_id)->get();
        
        
        $situacaoes = \App\AtendimentoSituacao::where("ativo",1)->get();
        
        return view('problema.chamado_detalhes', compact('chamados','historicos','situacaoes','sinistro_id'));

        
        
    }    
    
    
    public function biometria(Request $request){
        
        return view('problema.biometria');

        
    }
    
    public function biometria_save(Request $request){
        
        $sinistro = new \App\Sinistro();
        $sinistro->ip = $request->ip();
        $sinistro->data_lancamento = date("Y-m-d H:i:s");
        $sinistro->solicitante = $request->input("solicitante");
        $sinistro->solicitante_email = $request->input("solicitante_email");
        $sinistro->descricao = $request->input("descricao");
        $sinistro->solicitante_matricula  = $request->input("solicitante_matricula");
        $sinistro->ativo = 1;
        $sinistro->save();
        
        $sinistro_problema = new \App\SinistroProblema();
        $sinistro_problema->sinistro_id = $sinistro->id;
        $sinistro_problema->problema_id = 4; // Solicitar cadastro biometria
        $sinistro_problema->save();
        
        return array("erro"=>0, "mensagem"=>"Solicitação realizada com sucesso");

        
    }
    
    public function problema_salvar(Request $request){
        
        $sinistro = new \App\Sinistro();
        $sinistro->ip = $request->ip();
        $sinistro->data_lancamento = date("Y-m-d H:i:s");
        $sinistro->solicitante = $request->input("solicitante");
        $sinistro->solicitante_email = $request->input("solicitante_email");
        $sinistro->descricao = $request->input("descricao");
        $sinistro->solicitante_matricula  = $request->input("solicitante_matricula");
        $sinistro->ativo = 1;
        $sinistro->save();
        
        if(count($request->input("problema_id")) > 0){
            foreach ($request->input("problema_id") as $problema){

                $sinistro_problema = new \App\SinistroProblema();
                $sinistro_problema->sinistro_id = $sinistro->id;
                $sinistro_problema->problema_id = $problema;
                $sinistro_problema->save();

            }
        }else{
            
            $sinistro_problema = new \App\SinistroProblema();
            $sinistro_problema->sinistro_id = $sinistro->id;
            $sinistro_problema->problema_id = 5;  //Outros problemas
            $sinistro_problema->save();
            
        }
        return array("erro"=>0, "mensagem"=>"Solicitação realizada com sucesso");
        
    }
    
    public function solicitar_email(Request $request){
        
        $sinistro = new \App\Sinistro();
        $sinistro->ip = $request->ip();
        $sinistro->data_lancamento = date("Y-m-d H:i:s");
        $sinistro->solicitante = $request->input("solicitante");
        $sinistro->solicitante_email = $request->input("solicitante_email");
        $sinistro->solicitante_matricula  = $request->input("solicitante_matricula");
        $sinistro->ativo = 1;
        $sinistro->save();
            
        $sinistro_problema = new \App\SinistroProblema();
        $sinistro_problema->sinistro_id = $sinistro->id;
        $sinistro_problema->problema_id = 3; // TIPO solicitação de E-mail
        $sinistro_problema->save();

        return array("erro"=>0, "mensagem"=>"Solicitação de e-mail realizada com sucesso");
        
    }
    
    
}