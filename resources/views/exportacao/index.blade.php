<script>

    function exportar_pesquisa(){
    
        if($("#problema_id").val().trim() == "0"){
            $("#MODAL_ERRO_MENSAGEM").html("Informe o tipo do chamado");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
        
        if($("#atendimento_situacao_id").val().trim() == "0"){
            $("#MODAL_ERRO_MENSAGEM").html("Informe a situação do chamado");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
        
        

        $("#download_texto").html("");
    
        $.ajax({

            type: "POST",
            url: "/exportacao/gerar_arquivo",
            data: {

                "_token": $("#token").val(),
                "problema_id": $("#problema_id").val(),
                "atendimento_situacao_id": $("#atendimento_situacao_id").val()
                
            },
            success: function (data) {

            
                    if(data.erro == "1"){
                    
                        $("#MODAL_ERRO_MENSAGEM").html("Sem dados para os filtros informados");

                        $('#MODAL_ERRO').modal();
                    }else{

                        $("#download_id").attr("href","/exportacao/download/" + data.arquivo_nome);
                        $("#download_texto").html(data.contador + " registros gerados, Clique aqui para Download");
                    
                    }
                
                
            }

        });
    
    }
    
    function limpar_pesquisa(){
    
        $("#download_texto").html("");
    
    }



</script>

<!-- Modal alert -->
<div id="MODAL_ERRO" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-header-warning">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alerta</h4>
            </div>
            <div class="modal-body">
                <strong id="MODAL_ERRO_MENSAGEM">Some text in the modal.</strong>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal alert -->
<div id="MODAL_SUCESSO" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sucesso</h4>
            </div>
            <div class="modal-body">
                <strong id="MODAL_SUCESSO_MENSAGEM">Some text in the modal.</strong>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>


<form id="FORM_ATENDENTE">
    <div class="row">
        
        <div class="col-md-3">
            
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-left">Exportação de chamados</div>
                <div class="panel-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                    <div class="row text-left">
                        <div class="col-md-6">

                        </div>                                    

                    </div>
                    <br>
                    <br>

                    <div class="row">
                        
                        <div class="col-md-12 text-left">

                            <label >Tipos de chamado *</label>
                            
                            <select onchange="limpar_pesquisa()" id="problema_id" name="problema_id" class="form-control">
                                <option value="0">Selecione o tipo do chamado</option>
                                @forelse($problemas AS $problema)                            
                                <option value="{{ $problema->id}}">{{ $problema->descricao}}</option>
                                @empty
                                @endforelse
                            </select>


                        </div>
                        
                        
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12 text-left">

                            <label >Situação do chamado *</label>
                            
                            <select onchange="limpar_pesquisa()" id="atendimento_situacao_id" name="atendimento_situacao_id" class="form-control">
                                <option value="0">Selecione a situação do chamado</option>
                                @forelse($situacoes AS $situacao)                            
                                <option value="{{ $situacao->id}}">{{ $situacao->descricao}}</option>
                                @empty
                                @endforelse
                            </select>


                        </div>
                        
                        
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            
                            <button onclick="exportar_pesquisa()" type="button" class="btn btn-success">Gerar arquivo</button>
                        </div>
                    
                    </div>
                    <br>
                    
                    <div class="row">
                        
                        <div id="pesquisa_ranking" class="col-md-12 text-center">
                            
                            <a id="download_id" href=""><h3 id="download_texto"></h3></a>

                        </div>                                    

                    </div>
                    

                    
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
        </div>
    </div>

</form>

<script> 

    
    
</script>