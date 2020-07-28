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
    
        if($("#solicitante_email").val().trim() == ""){
            $("#MODAL_ERRO_MENSAGEM").html("Informe seu e-mail");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
    
        var email_valid = checkMail($("#solicitante_email").val());
        
        if( (email_valid == false ) || $("#solicitante_email").val() == "" ){
        
            $("#MODAL_ERRO_MENSAGEM").html("E-mail em formato inválido");
            
            $('#MODAL_ERRO').modal();
            
            return;
        }
        
        var problema_id = [];
    
        $('input[name=problema_id]:checked').each(function() {
        
            problema_id.push($(this).val());
            
        });
        
        if((problema_id.length == 0) && $("#descricao").val().trim() == "" ){
        
            $("#MODAL_ERRO_MENSAGEM").html("Informe A DESCRIÇÃO DO PROBLEMA ou marque um PROBLEMA na lista");
            
            $('#MODAL_ERRO').modal();
            
            return;
        
        
        }
        
        $.ajax({

            type: "POST",
            url: "/problema/save",
            data: {

                "_token": $("#token").val(),
                "solicitante": $("#solicitante").val(),
                "solicitante_email": $("#solicitante_email").val(),
                "solicitante_matricula": $("#solicitante_matricula").val(),
                "descricao": $("#descricao").val(),
                "problema_id[]" : problema_id

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
        <!--
        
        <div class="col-sm-2">

        </div>
        -->
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-left">Informa problemas na matrícula</div>
                <div class="panel-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                    <div class="row text-left">
                        <div class="col-md-6">
                            <image  width="32" height="32"  onclick="showForm('/menu')" style="background-color: yellowgreen" src="/assets/imagens/retornar.png" class="image image-responsive brd">  Voltar

                        </div>                                    

                    </div>

                    <div class="row">
                        <div class="col-md-6 text-left">

                            <label >Nome *</label>
                            <input maxlength="45"  value="" name="solicitante" id="solicitante" type="text" class="form-control input-lg" aria-label="Amount (to the nearest dollar)">


                        </div>
                        <div class="col-md-6 text-left">
                           

                            <label >E-mail pessoal / Institucional</label>
                            <input maxlength="45"  value="" name="solicitante_email" id="solicitante_email" type="email" class="form-control input-lg" aria-label="Amount (to the nearest dollar)">


                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">

                            <label >Matricula *</label>
                            <input maxlength="45"  value="" name="solicitante_matricula" id="solicitante_matricula" type="text" class="form-control input-lg" aria-label="Amount (to the nearest dollar)">


                        </div>
                        <div  class="col-md-6 text-left">

                            <label  class="label label-warning" >Reclamação</label>
                            @forelse ($problemas as $problema)
                            <div class="form-check">
                                <input name="problema_id" value='{!!$problema->id !!}' type="checkbox" class="form-check-input" >
                                <label class="form-check-label" for="exampleCheck1">{!!$problema->descricao !!}</label>
                            </div>
                            @empty
                            @endforelse                            

                        </div>
                        
                        
                    </div>
                    <div class="row" >
                        <div class="col-md-12 text-left">
                            
                            <label labelfor="descricao" >Descrição do problema</label>


                            <textarea name="descricao" id="descricao" class="form-control input-sm" rows="15"  placeholder="Descreva o problema aqui...">
                            
                            </textarea>                            

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