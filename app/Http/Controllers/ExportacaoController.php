<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ExportacaoController extends Controller{


    public function index(Request $request){

        $empresa_id = $request->session()->get('empresa_id');
        
        $problemas = \App\Problema::where("ativo",1)->get();
        
        $situacoes = \App\AtendimentoSituacao::where("ativo",1)->get();
        
        return view('exportacao.index', compact('problemas','situacoes'));

    }
    
    public function download(Request $request , $arquivo_nome){
        
        $arquivo_nome = storage_path() ."/". $arquivo_nome .".csv";
        
        return Response()->download($arquivo_nome );        
        
    }
    public function gerar_arquivo(Request $request ){
        
        $problema_id = $request->input("problema_id");
        $atendimento_situacao_id = $request->input("atendimento_situacao_id");
        
        $sql = "select sp.id , solicitante , solicitante_email, solicitante_matricula, data_lancamento, situacao.descricao as situacao_descricao, p.descricao 
                        from sinistro as s 
                        inner join sinistro_problema as sp on (s.id = sp.sinistro_id)
                        inner join atendimento_situacao as situacao on (sp.problema_id = situacao.id)
                        inner join problema as p on (p.id = sp.problema_id)
                        where p.id = ? and sp.atendimento_situacao_id = ?
             ";

        
        $dados = DB::select( $sql, array($problema_id , $atendimento_situacao_id));
        $arquivo_nome = storage_path() ."/chamados_" . $problema_id .".csv";
        $arquivo = fopen($arquivo_nome,"w");
        $linha = "chamado_id;solicitante;solicitante_email;solicitante_matricula;data_lancamento;situacao_descricao\n";
        fwrite($arquivo, $linha);
        
        $contador = 0;
        $erro = 1;
        foreach($dados AS $dado){
            
            $linha = $dado->id .";".$dado->solicitante .";".$dado->solicitante_email .";".$dado->solicitante_matricula .";".$dado->data_lancamento .";".$dado->situacao_descricao ."\n";
            fwrite($arquivo, $linha);
            $erro = 0;
            $contador++;
        }
        
        fclose($arquivo);
        
        
        return array("erro"=> $erro,"contador"=> $contador ,"arquivo_nome" => "chamados_" . $problema_id , "mensagem"=>"Atualização realizada com sucesso");
        
    }

   
    
}