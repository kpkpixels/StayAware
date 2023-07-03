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
    <a id="linkbarra" class="acessado" href="cardapios.php">Cardápios</a>
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
      echo '<a id="linkbarra" href="admGerencia.php">Gerenciamento</a>';
    }
    elseif ($_SESSION['tipo']==2) {
      echo '<a id="linkbarra" href="admGerencia.php">Gerenciamento</a>';
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

$(function(){
  $("#corSig").click(function(){
    $("#abaSig").slideToggle();
  });
});

</script>

<div style="margin-top:20px; top:50px;" class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
  <a id="corSig">O que significam as cores?</a>
  <div id="abaSig" style="display: none; position: absolute; z-index:2;">
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(220,7,17);display: inline-flex;"></h5> - Plástico,
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(0,158,227);display: inline-flex;"></h5> - Papel,
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(164,87,0);display: inline-flex;"></h5> - Orgânico<br>
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(254,202,19);display: inline-flex;"></h5> - Metal,
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(89,89,89);display: inline-flex;"></h5> - Rejeito,
    <h5 style="width: 15px;height: 15px;border-radius: 50%;border: 5px solid rgb(107,143,21);display: inline-flex;"></h5> - Vidro<br>
  </div>
</div>

<div class="row">
  <?php
  $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
  $resultado = mysqli_query($mysqli,"SELECT * FROM cardapios WHERE id = " .$_GET['id']);
  $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
  }

  $data = date('d-m-Y', strtotime($cardapios[0]["dia"]));

  $datan = str_replace('-','/',$data);
  ?>

  <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 pesquisar">

    <?php
    $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
    $resultado = mysqli_query($mysqli,"SELECT * FROM cardapios WHERE id = " .$_GET['id']);
    $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    foreach ($cardapios as $manha) {

      $resul = mysqli_query($mysqli,"SELECT id_item FROM cardapio_item WHERE id_cardapio = ".$manha["id"]);
      $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);

      $data = date('d-m-Y', strtotime($manha["dia"]));

      $datan = str_replace('-','/',$data);

      echo '

      <h1 style="text-align: center"> Cardápio do dia '.$datan.' </h2>
      <h1 style="text-align: center"> Turno: '.$cardapios[0]["turno"].' </h2>';

      if(isset($_SESSION['tipo'])){
        echo '<a id="botaoEdit" style="font-size:50px" class="glyphicon glyphicon-cog edit" href="editarCardapio.php?id='.$cardapios[0]["id"].'"></a>';
      }

      echo '<br>';

      foreach ($relacao as $nomeItem) {
        $resi = mysqli_query($mysqli,"SELECT * FROM itens WHERE id = ".$nomeItem["id_item"]);
        $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);

        $resul2 = mysqli_query($mysqli,"SELECT id_residuo FROM item_residuo WHERE id_item = ".$nomeItem["id_item"]);
        $relacao2 = mysqli_fetch_all($resul2, MYSQLI_ASSOC);

        echo '
        <div class="col-md-4 col-sm-6 col-xs-12 cardapio">
        <h2 style="text-align: center">'.$resicao[0]["nome"].'</h2>
        <p style="text-align: center"><img style="width:200px; height:200px; border-radius:50%;"src="'.$resicao[0]["img"].'"></p>
        <h5 style="text-align: center">'.$resicao[0]["quantidade"].' '.$resicao[0]["uni_med"].'</h5>
        <br>';
        foreach ($relacao2 as $nomeResi) {
          $resi2 = mysqli_query($mysqli,"SELECT * FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
          $resicao2 = mysqli_fetch_all($resi2, MYSQLI_ASSOC);
          echo '
          <div class="col-md-4 col-sm-4 col-xs-4">
          <p style="text-align: center" class="reticencias">'.$resicao2[0]["nome"].'</p>';

          if ($resicao2[0]["tipo"]=="Plástico"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(220,7,17);"src="'.$resicao2[0]["img"].'"></p>';
          }
          if ($resicao2[0]["tipo"]=="Papel"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(0,158,227);"src="'.$resicao2[0]["img"].'"></p>';
          }
          if ($resicao2[0]["tipo"]=="Orgânico"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(164,87,0);"src="'.$resicao2[0]["img"].'"></p>';
          }
          if ($resicao2[0]["tipo"]=="Metal"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(254,202,19);"src="'.$resicao2[0]["img"].'"></p>';
          }
          if ($resicao2[0]["tipo"]=="Vidro"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(107,143,21);"src="'.$resicao2[0]["img"].'"></p>';
          }
          if ($resicao2[0]["tipo"]=="Rejeito"){
            echo '<p style="text-align: center"><img style="width:100px; height:100px; border-radius:50%;border: 5px solid rgb(89,89,89);"src="'.$resicao2[0]["img"].'"></p>';
          }
          echo '</div>';

        }
        echo '</div>';

      }


    }

    ?>
  </div>
  <?php
  $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');

  if ($manha['turno']=="Ambos") {
    $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia<'".$manha['dia']."' ORDER BY dia DESC, turno DESC");
    $cardapioMenor = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia>'".$manha['dia']."' ORDER BY dia ASC, turno ASC");
    $cardapioMaior = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);

    if (count($cardapioMaior)==0) {
      $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia ASC");
      $cardapioMaior = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
    if (count($cardapioMenor)==0) {
      $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia DESC");
      $cardapioMenor = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);
    }
  }
  if($manha['turno']=="Tarde"){
    $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia<='".$manha['dia']."' ORDER BY dia DESC");
    $cardapioMenor = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia>'".$manha['dia']."' ORDER BY dia ASC");
    $cardapioMaior = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);

    if (count($cardapioMaior)==0) {
      $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia ASC");
      $cardapioMaior = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
    if (count($cardapioMenor)==0) {
      $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia DESC");
      $cardapioMenor = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);
    }
  }
  if($manha['turno']=="Manhã"){
    $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia<'".$manha['dia']."' ORDER BY dia DESC");
    $cardapioMenor = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios WHERE dia>='".$manha['dia']."' ORDER BY dia ASC");
    $cardapioMaior = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);

    if (count($cardapioMaior)==0) {
      $resultado = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia ASC");
      $cardapioMaior = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
    if (count($cardapioMenor)==0) {
      $resultado2 = mysqli_query($mysqli,"SELECT id FROM cardapios ORDER BY dia DESC");
      $cardapioMenor = mysqli_fetch_all($resultado2, MYSQLI_ASSOC);
    }
  }


  echo'
  <a class="left carousel-control" href="cardapio.php?id='.$cardapioMenor[0]['id'].'" data-slide="prev">
  <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="cardapio.php?id='.$cardapioMaior[0]['id'].'" data-slide="next">
  <span class="icon-next"></span>
  </a>
  ';
  ?>

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

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>


</body>

</html>
