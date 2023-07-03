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
<script src="js/funcoes.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<?php

  $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
  $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE ID = ".$_GET['id']);
  $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  $nome_login = $usuarios[0]['nome_log'];
  $email = explode("@", $usuarios[0]['email']);
  $email2 = $usuarios[0]['email'];

  function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
  }

?>

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
      var login_cookie = "<?php echo "$nome_login" ?>";
      if (login_cookie != $("#nome_id").val()){
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
      }else{
        $("#statusLogin").html("Login disponível.");
        $("#botaoCad").attr("disabled", false);
      }
    }

    function verificarEmail(campo) {
      var email_cookie = "<?php echo "$email2" ?>";
      var emailnovo = $("#text").val()+"@feliz.ifrs.edu.br";
      if (email_cookie != emailnovo){
        jQuery.ajax({
          url: "verificaValida.php",
          data:'email='+$(campo).val(),
          type: "POST",
          success:function(data){

            if(data == true){
              $("#statusEmail").html("<font color='red'>Email já cadastrado!</font>");
              $("#botaoCad").attr("disabled", true);
            }else{
              $("#statusEmail").html("Email disponível.");
              $("#botaoCad").attr("disabled", false);
            }
          },
          error:function (){}
        });
      }else{
        $("#statusEmail").html("Email disponível.");
        $("#botaoCad").attr("disabled", false);
      }
    }
    </script>

        <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-12">
            <h4>Usuário</h4>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="cadastrarUser.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarUser.php"> Listar</button>
            <br>
            <br>
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
            <button id="botao" type="submit" formaction="cadastrarCardapio.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarCardapio.php"> Listar</button>


          </form>
        </div>
          <div class="col-md-10 col-sm-10 col-xs-12" id="resultado">
                <h1>Editar usuário</h1>
                <br>
                <form name="formcadas" action='acoesUsuario.php' method='post'>
                      <div class="group col-md-6">
                        <input type="text" name="nomeUsuario" maxlength="250" required value=<?php echo "'".$usuarios[0]['nome']."'"; ?>>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nome</label>
                      </div>
                      <div class="group col-md-6">
                        <input type="text" name="sobrenomeUsuario" maxlength="100" required value=<?php echo "'".$usuarios[0]['sobrenome']."'"; ?>>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Sobrenome</label>
                      </div>
                      <div class="group col-md-6">
                        <input type="text" id="text" name="emailUsuario" onkeyup="validar(this,'text');" autocomplete="off" onchange="verificarEmail(this)" maxlength="100" required value=<?php echo "'".$email[0]."'"; ?> style="width:140px;display:inline;">
                        <p style="display:inline; font-size:20px;">@feliz.ifrs.edu.br</p>
                        <span class="highlight"></span>
                        <span style="width:140px;" class="bar"></span>
                        <label>Email</label>
                        <h5 id='statusEmail'>Exemplo: nomesobrenome@feliz.ifrs.edu.br</h5>
                      </div>
                      <div class="group col-md-6">
                        <span id="spanselect" required>Nome de Login</span>
                        <input type="text" name="nome_logUsu" value=<?php echo "'".$usuarios[0]['nome_log']."'"; ?> onchange="verificarLogin(this)" id="campoLogin" maxlength="250" disabled>
                        <span class="highlight"></span>
                        <span class="bar"></span>

                        <h5 id='statusLogin'>Exemplo: nome_sobrenome</h5>
                      </div>
                      <div class="group col-md-6">
                        <input type="password" name="senha" maxlength="50" disabled>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Senha</label>

                      </div>
                      <div class='group col-md-6'>
                        <div class="checkbox">
                        <input id="checkbox1" name="reiniciar" type="checkbox">
                        <label for="checkbox1">
                            Alterar para senha padrão
                        </label>
                        </div>
                      </div>
                      <div class="group col-md-6 alert alert-warning">
                        <strong>Atenção!</strong> A senha padrão é 0123.
                      </div>


                      <input type='hidden' name='nome_logUsu' value= <?php echo $usuarios[0]['nome_log']; ?>>
                      <input type='hidden' name='senhaUsuario' value= <?php echo $usuarios[0]['senha']; ?>>

                      <div class="group col-md-12">
                        <input type="text"  id="campoTelefone" name="telefoneUsuario" required value=<?php echo $usuarios[0]['telefone']; ?>>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Telefone</label>
                      </div>
                      <div class="group col-md-2">
                        <span id="spanselect">Função</span>
                        <div class="select-style">
                          <select name="funcaoUsuario" >
                            <option value="Almoxarife" <?php echo selected( 'Almoxarife', $usuarios[0]['funcao'] ); ?>>Almoxarife</option>
                            <option value="Administrador" <?php echo selected( 'Administrador', $usuarios[0]['funcao'] ); ?>>Administrador</option>
                          </select>
                        </div>
                      </div>
                      <div class="group col-md-2">
                        <span id="spanselect">Status</span>
                        <div class="select-style">
                          <select name="statusUsuario" >
                            <option value="Ativo" <?php echo selected( 'Ativo', $usuarios[0]['status'] ); ?>>Ativo</option>
                            <option value="Inativo" <?php echo selected( 'Inativo', $usuarios[0]['status'] ); ?>>Inativo</option>
                          </select>
                        </div>
                      </div>

                      <input type='hidden' name='id' value= <?php echo $usuarios[0]['ID']; ?>>

                      <div class="group col-md-12">
                        <input type='submit' name='botao' value='Alterar'>
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
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js">

      $("#campoTelefone").unmask("+99(99)9999-9999");
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">	document.formcadas.nomeUsuario.focus();</script>

</body>

</html>
