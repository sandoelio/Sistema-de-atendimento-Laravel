
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Unirb - Sistema de Gestão em Pesquisa</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('/assets/css/bootstrap.css') !!}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style>body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #023160;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

@-ms-viewport     { width: device-width; }
@-o-viewport      { width: device-width; }
@viewport         { width: device-width; }
</style>
</head>
<body style="background-color: #444446">    
  </head>

  <body>

    <div class="container">
        <table align="center">
            <tr>
                <td align="center">
                    <img  width="315" class="image image-responsive" src="assets/imagens/unirb_logo.png">
                </td>
            </tr>
        </table>
      <form class="form-signin text-center" action="/validar" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token() }}">
        
        <label for="inputEmail" class="sr-only">Email </label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-mail ou Usuário" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <br>
        <br>
        <br>
        <br>
         <!-- <a style="border:1px solid #ffffff" class="btn btn-success" href="/lead/senha-recuperar" >Esqueci minha senha</a> 
        <br>
        <br>
        <br>
        <br>
        <a role="button" style="border:1px solid #ffffff" class="btn btn-warning active" href="/atividade-e-exercicios-para-educacao-sem-impressao" >Fazer meu cadastro</a> 
        -->
      </form>

    </div> <!-- /container -->


  </body>
</html>
