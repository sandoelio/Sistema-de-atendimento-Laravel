<script>
    
    function historico_salvar() {

        if($("#descricao").val().trim() == ""){
            $("#MODAL_ERRO_MENSAGEM").html("Informe a descrição do atendimento");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
    
        if($("#atendimento_situacao_id").val().trim() == "0"){
            $("#MODAL_ERRO_MENSAGEM").html("Informe a situação do atendimento");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
    
    
        
        $.ajax({

            type: "POST",
            url: "/problema/detalhes/save",
            data: {

                "_token": $("#token").val(),
                "sinistro_id": $("#sinistro_id").val(),
                "descricao": $("#descricao").val(),
                "atendimento_situacao_id": $("#atendimento_situacao_id").val(),
                "sinistro_problema_id": $("#sinistro_problema_id").val()

            },
            success: function (data) {
                
                if(data.erro == 0){
                    
                    showForm('/problema/detalhes/' + data.sinistro_id);
                    
                }else{
                    
                    $('#MODAL_ERRO').modal();
                    $("#MODAL_ERRO_MENSAGEM").html(data.mensagem);
                    
                }
            }

        });
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
    <!--
    <div class="col-sm-2">

    </div>
    -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-left">Chamados</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-2 text-left">
                                
                            <image  width="32" height="32"  onclick="showForm('/problema/lista')" style="background-color: yellowgreen" src="/assets/imagens/retornar.png" class="image image-responsive brd">
                            
                            </div>

                        </div>
                    </div>
                    
                    <br>
                    <br>
                    
                    <div class="row">
                            
                        <div class="col-md-12">
                            
                            <table id="myTable" width="" class="table table-bordered table-striped">
                                @forelse($chamados AS $chamado)
                                
                                <input type="hidden" name="sinistro_problema_id" id="sinistro_problema_id" value="{!! $chamado->id!!}">
                                <tr>
                                    <td>
                                        <label >Solicitante:</label>
                                        {!!$chamado->solicitante!!}
                                    </td>
                                    <td colspan="2" class="text-left">
                                        <label >E-mail:</label>
                                        {!!$chamado->solicitante_email !!}
                                    </td>
                              </tr>
                                <tr>
                                    <td>
                                        <label >Situação:</label>

                                        {!!$chamado->situacao_descricao!!}
                                    </td>
                                    <td class="text-left">
                                        <label >Data:</label>

                                        {!!$chamado->data_lancamento !!}
                                    </td>
                                    <td class="text-left">
                                        <label >Matricula:</label>

                                        {!!$chamado->solicitante_matricula !!}
                                    </td>
                                    
                              </tr>
                                <tr>
                                    <td colspan="3" class="text-left">
                                        <label >Descrição:</label>

                                        {!!$chamado->descricao !!}
                                        <br>
                                        <label >Observação:</label>
                                        {!!$chamado->sinistro_descricao !!}
                                        
                                    </td>
                                </tr>    

                                @empty
                                @endforelse     
                                
                                <tr>
                                    <td colspan="3" class="text-center text-info">
                                        <h4>Histórico de atendimento</h4>

                                    </td>
                                </tr>    
                                @forelse($historicos AS $historico)
                                <tr>
                                    
                                    <td>
                                        <label >Situação:</label>
                                        <p>
                                        {!!$historico->situacao!!}
                                    </td>
                                    <td class="text-left">
                                        <label >Técnico:</label>
                                        <p>

                                        {!!$historico->nome !!}
                                    </td>
                                    <td class="text-left">
                                        <label >Data:</label>
                                        <p>

                                        {!!$historico->data_ocorrencia !!}
                                    </td>
                                    
                                </tr>
                                
                                <tr>
                                    
                                    <td colspan="3">
                                        <label >Descrição:</label>
                                        <p>

                                        {!!$historico->historico!!}
                                    </td>
                                    
                                </tr>                                
                                @empty
                                @endforelse     
                                
                                <tr>
                                    
                                    <td colspan="3">
                                        
                                        <div class="form-group">
                                            <p>
                                           <input type="hidden" value="{!! $sinistro_id !!}" id="sinistro_id"> 
                                           <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                           
                                          <label for="descricao">Descrição do atendimento:</label>
                                          <textarea class="form-control input-sm"  id="descricao" name="descricao" rows="10"></textarea>
                                        </div>
                                        
                                    </td>
                                    
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <label for="exampleFormControlTextarea1">Situação:</label>
                                        <select id="atendimento_situacao_id" name="atendimento_situacao_id" class="form-control">
                                            <option value="0">Informe a situação</option>
                                            @forelse($situacaoes AS $situacao)
                                            <option value="{!! $situacao->id !!}">{!! $situacao->descricao !!}</option>
                                            @empty
                                            @endforelse     
                                          
                                        </select>                                        
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">

                                        <button onclick="historico_salvar()" type="button" class="btn btn-md btn-success">Salvar</button>

                                    </td>
                                </tr>
                                
                            </table>        
                        
                        </div>
                            
                    </div>                            
                    <div class="row">
                            
                        <div class="col-md-12">
                            
                        
                        </div>
                        
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
    
</form>
