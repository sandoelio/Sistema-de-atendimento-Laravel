<script>
    
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-left">Local</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="row">
                                            <div class="col-md-2 text-left">
                                                <image   width="32" height="32"  onclick="showForm('/local/create')" style="background-color: green" title='Cadastro' src="/assets/imagens/novo.png" class="image image-responsive brd">
                                            </div>
                                            
                                        </div>
                                        
                                        <br>
                                        <input placeholder="Pesquisa" onkeyup="myFunction()" type="text" class="form-control" id="myInput">
                                        <table id="myTable" class="table table-bordered table-striped">
                                          <tr>
                                            <th class="text-left">ID</th>
                                            <th class="text-left">Descrição</th> 
                                            <th class="text-center">Situação</th> 
                                            <th class="text-center">Ações</th>
                                          </tr>
                                            @forelse($locais AS $local)
                                            <tr>
                                            <td>{!!$local->id!!}</td>
                                            <td class="text-left">
                                                {!!$local->descricao !!}
                                            </td>
                                            <td class="text-center">
                                                
                                                @if($local->ativo == 1)
                                                <span class="label label-success">Ativo</span>
                                                @endif
                                                @if($local->ativo == 0)
                                                <span class="label label-danger">Inativo</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button onclick="showForm('/local/edit/{!!$local->id!!}')" type="button" class="btn btn-sm btn-success">Editar</button>

                                                @if($local->ativo == 1)
                                                <button onclick="ativar_desativar('/local/ativar/{!!$local->id!!}/0')" type="button" class="btn btn-sm btn-danger">Desativar</button>
                                                @endif
                                                @if($local->ativo == 0)
                                                <button onclick="ativar_desativar('/local/ativar/{!!$local->id!!}/1')" type="button" class="btn btn-sm btn-primary">Ativar</button>
                                                @endif
                                                
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
