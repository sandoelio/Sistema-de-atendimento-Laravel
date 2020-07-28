<script>
    
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      console.log($("#myInput").val());
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0] ;
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }

    function ativar_desativar(url_ativar){
        
        $.ajax({

            type: "GET",

            url: url_ativar,

            success: function (data) {
            
                showForm('/local');
                
            }

        });
        
    }


</script>                


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
                                
                            </div>

                        </div>

                        <br>
                        <input placeholder="Pesquisa por matrícula" onkeyup="myFunction()" type="text" class="form-control" id="myInput">
                        <table id="myTable" class="table table-bordered table-striped">
                          <tr>
                            <th class="text-center">Matricula</th>
                            <th class="text-left">Aluno</th> 
                            <th class="text-left">E-mail</th> 
                            <th class="text-center">Data</th> 
                            <th class="text-left">Situação</th>
                            <th class="text-left">Descrição</th>
                            <th class="text-center">Opções</th>
                          </tr>
                            @forelse($chamados AS $chamado)
                            <tr>
                            <td class="text-center">
                                {!!$chamado->solicitante_matricula !!}
                            </td>
                            <td>
                                {!!$chamado->solicitante!!}
                            </td>
                            <td class="text-left">
                                {!!$chamado->solicitante_email !!}
                            </td>
                            <td class="text-center ">
                                {!!$chamado->data_lancamento !!}
                            </td>
                            <td class="text-left">
                                {!!$chamado->situacao_descricao !!}
                            </td>
                            <td class="text-left">
                                {!!$chamado->descricao !!}
                            </td>
                            <td class="text-center">
                                <button onclick="showForm('/problema/detalhes/{!! $chamado->id !!}')" type="button" class="btn btn-sm btn-success">Atender</button>

                            </td>
                          </tr>
                            @empty
                            <tr>
                            <td colspan="4">Nada foi encontrado!</td>
                            </tr>
                            @endforelse

                        </table>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
