<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Login do sistema
Route::get('/login', "LoginController@index");
Route::post('/validar', "LoginController@loginValidate");
Route::get('/logout', "LoginController@logout");
Route::get("teste","LoginController@limpar_cache");


// BrBolsas Pesquisa
Route::get("/brbolsas","BrBolsasController@index");
Route::get("/brbolsas/{curso_id}","BrBolsasController@curso");
Route::post("/brbolsas/save","BrBolsasController@save");
Route::post("/brbolsas/mensagem","BrBolsasController@mensagem");

//Route::get("/teste","SistemaController@teste");

Route::group(['middleware' => 'autorizacao'], function() {

    Route::get('/', "SistemaController@index");
    Route::get('/atendimento', "SistemaController@index");
    Route::get("/menu","SistemaController@menu");
    Route::get("/email","EmailController@index");
    Route::get("/problema","ProblemaController@index");
    Route::get("/biometria","ProblemaController@biometria");
    Route::post("/biometria/save","ProblemaController@biometria_save");
    Route::post("/problema/save","ProblemaController@problema_salvar");
    Route::post("/problema/solicitar-email","ProblemaController@solicitar_email");
    Route::get("/problema/lista","ProblemaController@lista");
    Route::get("/problema/detalhes/{sinistro_id}","ProblemaController@detalhes");
    Route::post("/problema/detalhes/save","ProblemaController@detalhes_save");
    
    
    
    

    // Exportação do arquivos
    Route::get('/exportacao', "ExportacaoController@index");
    Route::post('/exportacao/gerar_arquivo', "ExportacaoController@gerar_arquivo");
    Route::get('/exportacao/download/{arquivo_nome}', "ExportacaoController@download");
    
    
    
    // Relatórios
    Route::get('/relatorio/detalhe', "RelatorioController@detalhe_home");
    Route::post('/relatorio/detalhe/lista', "RelatorioController@detalhes_lista");

    Route::get('/relatorio/ranking', "RelatorioController@ranking_home");
    Route::post('/relatorio/ranking/lista', "RelatorioController@ranking_lista");

    Route::get('/relatorio/perguntas/{pesquisa_id}', "RelatorioController@perguntas");


    // Atendentes
    Route::get('/atendente', "AtendenteController@index");
    Route::get('/atendente/create', "AtendenteController@create");
    Route::get('/atendente/edit/{id}', "AtendenteController@edit");
    Route::post('/atendente/save', "AtendenteController@save");
    Route::post('/atendente/update', "AtendenteController@update");
    Route::get('/atendente/ativar/{atendente_id}/{ativo}', "AtendenteController@ativar");

    // Categorias
    Route::get('/categoria', "CategoriaController@index");
    Route::get('/categoria/create', "CategoriaController@create");
    Route::get('/categoria/edit/{id}', "CategoriaController@edit");
    Route::post('/categoria/save', "CategoriaController@save");
    Route::post('/categoria/update', "CategoriaController@update");
    Route::get('/categoria/ativar/{categoria_id}/{ativo}', "CategoriaController@ativar");

    
    // Locais
    Route::get('/local', "LocalController@index");
    Route::get('/local/create', "LocalController@create");
    Route::get('/local/edit/{id}', "LocalController@edit");
    Route::post('/local/save', "LocalController@save");
    Route::post('/local/update', "LocalController@update");
    Route::get('/local/ativar/{local_id}/{ativo}', "LocalController@ativar");

    // Pesquisa
    Route::get('/pesquisa', "PesquisaController@index");
    Route::get('/pesquisa/create', "PesquisaController@create");
    Route::post('/pesquisa/save', "PesquisaController@save");
    Route::post('/pesquisa/pergunta/save', "PesquisaController@pesquisa_pergunta_save");
    Route::post('/pesquisa/pergunta/encluir', "PesquisaController@pesquisa_pergunta_excluir");
    Route::get('/pesquisa/pesquisa-perguntas/{id}', "PesquisaController@pesquisa_perguntas");
    Route::get('/pesquisa/perguntas/lista/{id}', "PesquisaController@pesquisa_perguntas_lista");
    Route::get('/pesquisa/publicar/{pesquisa_id}', "PesquisaController@publicar");
    Route::post('/pesquisa/publicar/save', "PesquisaController@publicar_save");


    // QrCode
    Route::get('/qrcode', "QrCodeController@index");


});


Route::get('/home', "PesquisaController@home");
Route::post('/home/salvar', "PesquisaController@salvar");
Route::get('/inicio', "PesquisaController@inicio");


