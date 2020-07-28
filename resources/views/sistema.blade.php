<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Unirb - Gestão de Pesquisa de satisfação</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/font-awesome.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <script src="/assets/js/jQuery-2.1.4.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/jquery.qrcode.min.js"></script>
        
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>        
        
        
        <script>
            
            function checkMail(mail){	
                var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);	

                if(typeof(mail) == "string"){ 

                    if(er.test(mail)){ 
                        return true; 
                    }

                }else if(typeof(mail) == "object"){

                    if(er.test(mail.value)){ 
                        return true;

                    }else{

                        return false;		
                    }
                }
            }

            
            
            function showForm(rota) {

                $("#CONTEUDO_SISTEMA").load(rota);

            }          
            
            function pontuar(celula_id , valor){
            
                $("#botao_salvar").css("display","block");
                
                $("#pontuacao").val(valor);
                
            }
            
            function salvar_1(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "pontuacao": $("#pontuacao").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            function salvar_2(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "observacao": $("#observacao").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            function salvar_3(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "observacao": $("#observacao").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            function salvar_4(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "cpf": $("#cpf").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            function salvar_5(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "cpf": $("#cpf").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            function salvar_6(){

                $.ajax({
                    type: "POST",
                    url: "/home/salvar",
                    data: {

                        "tipo_resposta_id": $("#tipo_resposta_id").val(),
                        "pergunta_id": $("#pergunta_id").val(),
                        "email": $("#email").val(),
                        "_token": $("[name='_token']").val()

                    },
                    success: function (response) {

                        $("#conteudo_pesquisa").html(response);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }

                });
                
            }
            
            
        </script>    
        
        <style>
            
            .modal-header-success {
                color:#fff;
                padding:9px 15px;
                border-bottom:1px solid #eee;
                background-color: #5cb85c;
                -webkit-border-top-left-radius: 5px;
                -webkit-border-top-right-radius: 5px;
                -moz-border-radius-topleft: 5px;
                -moz-border-radius-topright: 5px;
                 border-top-left-radius: 5px;
                 border-top-right-radius: 5px;
            }            

            .modal-header-warning {
                color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #f0ad4e;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
             border-top-left-radius: 5px;
             border-top-right-radius: 5px;
            }
            .modal-header-danger {
                    color:#fff;
                padding:9px 15px;
                border-bottom:1px solid #eee;
                background-color: #d9534f;
                -webkit-border-top-left-radius: 5px;
                -webkit-border-top-right-radius: 5px;
                -moz-border-radius-topleft: 5px;
                -moz-border-radius-topright: 5px;
                 border-top-left-radius: 5px;
                 border-top-right-radius: 5px;
            }
            .modal-header-info {
                color:#fff;
                padding:9px 15px;
                border-bottom:1px solid #eee;
                background-color: #5bc0de;
                -webkit-border-top-left-radius: 5px;
                -webkit-border-top-right-radius: 5px;
                -moz-border-radius-topleft: 5px;
                -moz-border-radius-topright: 5px;
                 border-top-left-radius: 5px;
                 border-top-right-radius: 5px;
            }
            .modal-header-primary {
                    color:#fff;
                padding:9px 15px;
                border-bottom:1px solid #eee;
                background-color: #428bca;
                -webkit-border-top-left-radius: 5px;
                -webkit-border-top-right-radius: 5px;
                -moz-border-radius-topleft: 5px;
                -moz-border-radius-topright: 5px;
                 border-top-left-radius: 5px;
                 border-top-right-radius: 5px;
            }            
            
            ul.menu_principal li{

                list-style-type: none;
                padding: 5px;
                display: inline;
            }
            .ponteiro{
                
                cursor: pointer;
            }
            .borda{
                
                border:2px solid white;
                cursor: pointer;
                background-color: white;
            }
            
            .ponteiro:hover{
                
                border: 2px solid #cdcdcd;
                border-radius: 6px;
                -webkit-border-radius: 6px; 
                -moz-border-radius: 6px; 
                background-color: greenyellow;

            }
            
            
        </style>
        
</head>
<body id="ROOT_SISTEMA" style=";background-image: url('/assets/imagens/background.jpg');background-size: cover;background-repeat: no-repeat; min-height: 100%;min-width: 100%;background-color: #12425d;background-attachment:fixed" >
    
    <div class="container">
    <div class="row">
        
        <table width="99%" border="0">
            <tr>
                <td align="left" width="15%">
                    <img style="margin-left: 15px" class="image image-responsive" width="170" src="/assets/imagens/unirb_logo.png">
                </td>
                <td align="center"  width="70%">

                    @if(Session::get('pessoa_perfil_id') != 1)
                    <h1 style="font-weight: 900;color:white;font-family: helvetica">ATENDIMENTO VIRTUAL</h1>
                    @endif
                    @if(Session::get('pessoa_perfil_id') == 1)

                    <ul class="menu_principal" style="list-style-position: inside;">
                        <li  >
                            <img  onclick="showForm('/problema/lista')" class="image image-responsive img-rounded borda"  width="48" src="/assets/imagens/atendente.png" title="Atendente">
                        </li>
                        <!--
                        
                        <li>
                            <img onclick="showForm('/local')" class="image image-responsive img-rounded borda"  width="48" src="/assets/imagens/local.png" title="Local/Unidade de pesquisa">
                        </li>
                        <li>
                            <img onclick="showForm('/categoria')" class="image image-responsive img-rounded borda"  width="48" src="/assets/imagens/categoria.png" title="Categoria da pergunta">
                        </li>
                        <li>
                            <img onclick="showForm('/pesquisa')" class="image  image-responsive img-rounded borda" width="48" src="/assets/imagens/pesquisa.png" title="Pesquisa">
                        </li>
                        <li>
                            <img  onclick=showForm("/relatorio/ranking") class="image img-rounded borda"  width="48" src="/assets/imagens/grafico.png" title="Grafico sobre pesquisa">
                        </li>

                        <li>
                            <img  onclick="showForm('/relatorio/detalhe')"  class="image image-responsive img-rounded borda" width="48" src="/assets/imagens/observacao.png" title="Crítica sobre pesquisa">
                        </li>
                       
                        <li>
                            <img   onclick="showForm('/qrcode')"   class="image  image-responsive img-rounded borda" width="48" src="/assets/imagens/qrcode.png" title="Gerar QrCode para pesquisa">
                        </li>
                         -->
                        <li>
                            <img   onclick="showForm('/exportacao')"   class="image  image-responsive img-rounded borda" width="48" src="/assets/imagens/excel.png" title="Exportação de arquivos">
                        </li>
                       
                    </ul>
                    @endif
                    
                </td>
                <td align="right" width="15%">
                    <a href="/logout"> 
                        <img style="margin-top:5px;margin-right: 20px" class="image image-responsive img-rounded borda" width="48" src="/assets/imagens/sair.png" title="Sair do sistema">
                    </a>
                    
                </td>
            </tr>
        </table>

        
        
    </div>
   
    
    
    <div id="CONTEUDO_SISTEMA">


    </div>    
        
    </div>        
    
</body>   

</html>


<script>

    @if(Session::get('pessoa_perfil_id') != 1)

        $("#CONTEUDO_SISTEMA").load("/menu");
    
    @endif    
        
    @if(Session::get('pessoa_perfil_id') == 1)

        //$("#CONTEUDO_SISTEMA").load("/problema/lista");
    
    @endif    
    
    
    
</script>
