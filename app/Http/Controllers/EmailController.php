<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Pessoa;
use App\AulaAvaliacao;
use App\AulaAvaliacaoQuesito;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EmailController extends Controller{

    
    public function index(Request $request){
        
        return view('email.email');
        
    }
    
    public function email_salvar(Request $request){
        
        //return view('email.email');
        
    }
    
    
}