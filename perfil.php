<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['tipo'])){
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
      echo '<a id="linkbarra"  class="acessado" href="admGerencia.php">Gerenciamento</a>';
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

<?php

  $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
  $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios WHERE ID = ".$_GET['id']);
  $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  $nome_login = $usuarios[0]['nome_log'];
  $email = explode("@", $usuarios[0]['email']);
  $email2 = $usuarios[0]['email'];

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
$(function(){
  $("#senha").change(function(){
      $(".confSenha").show(500);
  });
});

function validarSenha() {
  if ($("#senha").val() == $("#confSenha").val()) {
    $("#senhaCor").show();
    $("#senhaInc").hide();
    $("#botaoCad").attr("disabled", false);
  } else {
    $("#senhaInc").show();
    $("#senhaCor").hide();
    $("#botaoCad").attr("disabled", true);
  }
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
  <div class="col-md-12 col-sm-12 col-xs-12" id="resultado">
    <h1>Perfil</h1>
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
        <input type="text" id="text" name="emailUsuario" onkeyup="validar(this,'text');" onchange="verificarEmail(this)" autocomplete="off" maxlength="100" required value=<?php echo "'".$email[0]."'"; ?> style="width:140px;display:inline;">
        <p style="display:inline; font-size:20px;">@feliz.ifrs.edu.br</p>
        <span class="highlight"></span>
        <span style="width:140px;" class="bar"></span>
        <label>Email</label>
        <h5 id='statusEmail'>Exemplo: nomesobrenome@feliz.ifrs.edu.br</h5>
      </div>
      <div class="group col-md-6">
        <input type="text" name="nome_logUsu" id="nome_id" onchange="verificarLogin(this)" maxlength="250" required value=<?php echo $usuarios[0]['nome_log']; ?>>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nome de Login</label>
        <h5 id='statusLogin'>Exemplo: nome_sobrenome</h5>
      </div>
      <div class="group col-md-6">
        <input type="password" id="senha" onblur="validarSenha()" name="senhaUsuario" maxlength="50" required value=<?php echo $usuarios[0]['senha']; ?>>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Senha</label>
      </div>
      <div class="group col-md-6">
        <input type="text"  id="campoTelefone" name="telefoneUsuario" required value=<?php echo $usuarios[0]['telefone']; ?>>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Telefone</label>
      </div>
      <div class="group col-md-6 confSenha">
        <input type="password" id="confSenha" onblur="validarSenha()" name="senhaUsuario" maxlength="50" required value=<?php echo $usuarios[0]['senha']; ?>>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Confirmar senha</label>
        <div id="senhaCor">As senhas coincidem!</div>
        <div id="senhaInc">As senhas não coincidem!</div>
      </div>

      <input type='hidden' name='id' value= <?php echo $usuarios[0]['ID']; ?>>
      <div class="group col-md-12">
        <input type='submit' id="botaoCad" name='botao' value='Alterar perfil'>
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


</body>

</html>
