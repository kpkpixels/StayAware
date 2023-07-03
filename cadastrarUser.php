<!DOCTYPE html>

<?php
session_start();
if($_SESSION['tipo']!==1){
  session_destroy();
	header("location:index.php");
}

?>
<html>

  <?php
  include_once "navbar.php";
   ?>
                  <ul class="nav navbar-nav">
                    <li>
                    <a id="linkbarra" href=index.php>Início</a>
                  </li>
                    <li>
                        <a id="linkbarra" href="cardapios.php">Cardápios</a>
                    </li>
                    <li>
                        <a id="linkbarra" href="itens.php">Itens</a>
                    </li>

                    <li>
                      <?php
                      if(!isset($_SESSION['tipo'])){
                        echo '';
                      }
                      elseif ($_SESSION['tipo']==1) {
                        echo '<a id="linkbarra" class="acessado" href="admGerencia.php">Gerenciamento</a>';
                      }
                      elseif ($_SESSION['tipo']==2) {
                        echo '<a id="linkbarra" class="acessado" href="admGerencia.php">Gerenciamento</a>';
                      }
                      ?>
                    </li>

                  </ul>
              </div>
              <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
      </nav>


    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="js/funcoes.js" type="text/javascript"></script>

    <script>
    $(document).ready(function () {
     $('input').keypress(function (e) {
          var code = null;
          code = (e.keyCode ? e.keyCode : e.which);
          return (code == 13) ? false : true;
     });
   });
    function validar(dom,tipo){
    	switch(tipo){
    		case'text':var regex=/[-@!#$%¨&*+_´`^~;:?áÁéÉíÍóÓúÚãÃçÇ|\?,/{}"<>() ]/g;break;
    	}
    	dom.value=dom.value.replace(regex,'');
}

    jQuery(function($){
        $("#campoTelefone").mask("+99(99)99999-9999");

    });

    function verificarLogin(campo) {
                jQuery.ajax({
                url: "verificaValida.php",
                data:'login='+$(campo).val(),
                type: "POST",
                success:function(data){
            if(data == true){
              $("#statusLogin").html("<font color='red'>Login já cadastrado!</font>");
              $("#botaoCad").attr("disabled", true);
            }else{
              $("#statusLogin").html("Login disponível.");
              $("#botaoCad").attr("disabled", false);
            }
                },
                error:function (){}
                });
            }

    function verificarEmail(campo) {

        jQuery.ajax({
        url: "verificaValida.php",
        data: 'email='+$(campo).val(),
        type: "POST",
        success:function(data){

    if(data == true){
      $("#statusEmail").html("<font color='red'>Email já está cadastrado!</font>");
      $("#botaoCad").attr("disabled", true);
    }
      /*else if(data=="ja cadastrado"){
        $("#statusEmail").html("<font color='red'>Email já cadastrado!</font>");
        $("#botaoCad").attr("disabled", true);
      }*/
    else{
      $("#statusEmail").html("Email disponível.");
      $("#botaoCad").attr("disabled", false);
    }
        },
        error:function (){}
        });
      }


    </script>

        <div class="row">

          <div class="col-md-2 col-sm-2 col-xs-12">
            <?php
            if(!isset($_SESSION['tipo'])){
              echo '';
            }
            elseif ($_SESSION['tipo']==1) {
              echo '<h4>Usuário</h4>

              <form action="cadastrarUser" method="post">
              <button id="botao" type="submit" formaction="cadastrarUser.php"> Cadastrar</button>

              <form action="cadastrarUser" method="post">
              <button id="botao" type="submit" formaction="listarUser.php"> Listar</button>
              <br>
              <br>';
            }
            ?>

            <h4>Resíduo</h4>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="cadastrarResiduo.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarResiduo.php"> Listar</button>
            <br>
            <br>
            <h4>Item</h4>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="cadastrarItem.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarItem.php"> Listar</button>
            <br>
            <br>
            <h4>Cardápio</h4>

            <form action="cadastrarUser" method="post">
            <button id="botao" style="display:block; width:126.5px" type="submit" formaction="cadastrarCardapio.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarCardapio.php"> Listar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="replicarCardapio.php"> Replicar</button>

          </form>
        </div>

          <div class="col-md-10 col-sm-10 col-xs-12" >
                <h1>Cadastrar usuário</h1>
                <br>
                <form name="formcadas" action='acoesUsuario.php' method='post'>
                      <div class="group col-md-6">
                        <input type="text" name="nomeUsuario" maxlength="250" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nome</label>
                      </div>
                      <div class="group col-md-6">
                        <input type="text" name="sobrenomeUsuario" maxlength="100" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Sobrenome</label>
                      </div>
                      <!--
                      <div class="group col-md-6">
                        <input type="email" name="emailUsuario" onblur="verificarEmail(this)" maxlength="250" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Email</label>
                        <h5 id='statusEmail'>Exemplo: nomesobrenome@feliz.ifrs.edu.br</h5>
                      </div>
                    -->

                      <div class="group col-md-6">
                        <input type="text" id="text" name="emailUsuario" onkeyup="validar(this,'text');" autocomplete="off" onchange="verificarEmail(this)" maxlength="100" required style="width:140px;display:inline;">
                        <p style="display:inline; font-size:20px;">@feliz.ifrs.edu.br</p>
                        <span class="highlight"></span>
                        <span style="width:140px;" class="bar"></span>
                        <label>Email</label>
                        <h5 id='statusEmail'>Exemplo: nomesobrenome@feliz.ifrs.edu.br</h5>
                      </div>

                      <div class="group col-md-6" id="resultado">
                        <input type="text" id="nomeLog" maxlength="250" name="nome_logUsu" onchange="verificarLogin(this)" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nome de Login</label>
                        <h5 id='statusLogin'>Exemplo: nome_sobrenome</h5>
                      </div>
                      <div class="group col-md-6">
                        <input type="password" maxlength="50" name="senha" disabled>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Senha</label>
                      </div>
                      <div class="group col-md-5 alert alert-warning">
                        <strong>Atenção!</strong> A senha padrão é 0123.
                      </div>


                      <input type='hidden' name='senhaUsuario' value="0123">
                      <input type='hidden' name='statusUsuario' value="Ativo">


                      <div class="group col-md-12">
                        <input type="text" id="campoTelefone" name="telefoneUsuario" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Telefone</label>
                      </div>
                      <div class="group col-md-2">
                        <span id="spanselect">Função</span>
                        <div class="select-style">
                          <select name="funcaoUsuario" >
                            <option value="Almoxarife">Almoxarife</option>
                            <option value="Administrador">Administrador</option>
                          </select>
                        </div>
                      </div>

                      <div class="group col-md-12">
                        <input type='submit' name='botao' id="botaoCad" value='Inserir'>
                      </div>

                </form>

              </div>
                    </div>

            </div>
        </div>



        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                  <hr>
                    <p>Copyright &copy; Fique Esperto 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
  document.formcadas.nomeUsuario.focus();
</script>

</body>

</html>
