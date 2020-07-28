<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Pessoa;
use App\AulaAvaliacao;
use App\AulaAvaliacaoQuesito;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SistemaController extends Controller{


    public function teste(Request $request){
        
        $agente = strtolower($_SERVER['HTTP_USER_AGENT']);
        $validar = substr_count($agente,"mobile");
        
        if($validar){
            
            echo "IS MOBILE";
        }else{
            
            ECHO "DESKTOP ACCESS";
        }
        
        
        
    }
    public function index(Request $request){
        
        $dados = array("id"=>1,"nome"=>"Emerson Santamma");
        return view('sistema',compact("dados"));

    }
    
    public function menu(Request $request){
        
        return view('menu');
        
    }
    
    public function email(Request $request){
        
        return view('email.email');
        
    }
    
    public function email_salvar(Request $request){
        
        return view('email.email');
        
    }
    
    public function problema(Request $request){
        
        return view('problema.problema');
        
    }
    
    
    
    
}