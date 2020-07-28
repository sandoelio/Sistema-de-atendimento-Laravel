<script>

    function salvar() {

    
        if($("#solicitante").val().trim() == ""){
            $("#MODAL_ERRO_MENSAGEM").html("Informe seu nome");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
    
        if($("#solicitante_matricula").val().trim() == ""){
            $("#MODAL_ERRO_MENSAGEM").html("Informe sua matricula");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
    
        
        $.ajax({

            type: "POST",
            url: "/biometria/save",
            data: {

                "_token": $("#token").val(),
                "solicitante": $("#solicitante").val(),
                "solicitante_matricula": $("#solicitante_matricula").val(),

            },
            success: function (data) {
                
                if(data.erro == 0){
                    
                    $('#FORM_ATENDENTE').each (function(){
                      this.reset();
                    });        
                    
                    $('#MODAL_SUCESSO').modal();
                    $("#MODAL_SUCESSO_MENSAGEM").html(data.mensagem);
                    
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
        
        
        <div class="col-sm-2">

        </div>
        
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading text-left">Solicitar cadastro biométrico</div>
                <div class="panel-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                    <div class="row text-left">
                        <div class="col-md-6">
                            <image  width="32" height="32"  onclick="showForm('/menu')" style="background-color: yellowgreen" src="/assets/imagens/retornar.png" class="image image-responsive brd">  Voltar

                        </div>                                    

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-left">
                            <br>

                            <label >Nome *</label>
                            <input maxlength="45"  value="" name="solicitante" id="solicitante" type="text" class="form-control input-lg" aria-label="Amount (to the nearest dollar)">


                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <br>

                            <label >Matricula *</label>
                            <input maxlength="45"  value="" name="solicitante_matricula" id="solicitante_matricula" type="text" class="form-control input-lg" aria-label="Amount (to the nearest dollar)">


                        </div>
                        
                        
                    </div>
                    
                </div>
                <div class="panel-footer">
                    <button onclick="salvar()" type="button" class="btn btn-warning active">Enviar reclamação</button>
                </div>
            </div>
        </div>
    </div>

</form>