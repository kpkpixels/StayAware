<!DOCTYPE html>
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

<script>
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
  $("#campoTelefone").mask("+99(99)9999-9999");

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
}


</script>

<div class="row">
  <div class="col-lg-12" id="resultado">
    <h1>Recuperar senha</h1>
    <br>
    <form name="formcadas" action='acoesSenha.php' method='post'>
      <div class="group col-lg-6">
        <input type="email" name="emailUsuario" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Email</label>
      </div>
      <div class="group col-lg-12">
        <input type='submit' id="botaoCad" name='botao' value='Recuperar senha'>
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
