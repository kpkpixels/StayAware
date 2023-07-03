<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['tipo'])){
  session_destroy();
  header("location:index.php");
}

?>
<html>
<head>

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
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/funcoes.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.pt-BR.js" type="text/javascript"></script>

<script  type="text/javascript">
$(document).ready(function () {
 $('input').keypress(function (e) {
      var code = null;
      code = (e.keyCode ? e.keyCode : e.which);
      return (code == 13) ? false : true;
 });
});
function verificarData(campo) {
  var data= $("#dataCardapio").val();
  var turno= $("#turnoCardapio").val();
  jQuery.ajax({
    url: "verificaData.php",
    data:{data: data, turno:turno},
    type: "POST",
    success:function(data){
      if(data == true){
        $("#statusLogin").html("<font color='red'>Data sendo usada!</font>");
        $("#botaoReplica").attr("disabled", true);
      }else{
        $("#statusLogin").html("Data disponível.");
        $("#botaoReplica").attr("disabled", false);
      }
    },
    error:function (){}
  });
}
$(function(){
  $(".selectaba").change(function(){


    if( $(this).val() == 1){
      $(".aba1").show(500);
      $(".aba2").hide(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 2){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 2){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 3){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 4){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").show(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 5){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").show(500);
      $(".aba5").show(500);

    }


  });
  $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy',
        language: 'pt-BR'
      });
  $.fn.datetimepicker.defaults = {
      maskInput: true           // disables the text input mask
    };
});

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
                  <h1>Replicar cardápio</h1>
                  <br>
                  <form name="formcadas" action='acoesCardapio.php' method='post' enctype="multipart/form-data">

                    <div class="group col-md-2">
                      <span id="spanselect">Cardápios disponíveis</span>
                      <div class="select-style">
                        <select class="selectaba" name="cardapios" id="dataCopia">
                          <?php

                          $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                          $resultado = mysqli_query($mysqli,"SELECT dia, turno FROM cardapios ORDER BY dia DESC");
                          $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                          if(count($itens)==0){
                            echo " ";
                          }
                          else{

                            foreach ($itens as $item) {
                              $data = date('d-m-Y', strtotime($item["dia"]));
                              $dia = str_replace('-','/',$data);
                              echo "<option value=".$dia.'-'.$item["turno"].">".$dia."-".$item["turno"]."</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="group col-md-2">
                      <span id="spanselect">Replicar para o dia</span>
                      <div id="datetimepicker" class="input-append date">

                        <span class="add-on">
                          <input name="dataCardapio" id="dataCardapio" onblur="verificarData()" autocomplete="off" placeholder="--/--/----"style="width:120px" required></input>
                        </span>
                      </div>
                      <h5 id='statusLogin'>Exemplo: 12/12/2016</h5>

                    </div>
                    <div class="group col-md-2">
                      <span id="spanselect">Turno</span>
                      <div class="select-style">
                        <select class="selectaba" onblur="verificarData()" id="turnoCardapio" name="turnoCardapio" >
                          <option value="Ambos">Ambos</option>
                          <option value="Tarde">Tarde</option>
                          <option value="Manhã">Manhã</option>
                        </select>
                      </div>
                    </div>


                    <div class="group col-md-12">
                      <input type='submit' name='botaoCardapio' id="botaoReplica" value='Replicar'>
                    </div>

                  </form>

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

              <script src="js/bootstrap.min.js"></script>

              <script type="text/javascript">
              document.formcadas.cardapios.focus();
              </script>

            </body>

            </html>
