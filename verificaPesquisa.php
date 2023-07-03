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
    <a id="linkbarra" class="acessado" href="itens.php">Itens</a>
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

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/funcoes.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>


<script>

$(function(){
  $(".toggle1").click(
    function () {
      $(this).siblings(".tab2").hide(500);
      $(this).siblings(".aba").show(500);
    });

  });
  $(function(){
    $(".toggle2").click(
      function () {
        $(this).siblings(".aba").hide(500);
        $(this).siblings(".tab2").show(500);
      });

    });

    $(document).ready(function() {
      $(".but").click(function () {
        $(".but").removeClass("selected");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).addClass("selected");
      });
    });

</script>
<?php
include_once "./BD/MySQL.class.php";
$conexao = new MySQL();
$mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
$resultado = mysqli_query($mysqli,"SELECT * FROM itens");
$itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


if(isset($_POST['nome'])){
//falta o parametro pra filtrar o tipo
    $nome = $_POST['nome'];

    if ($_POST['tipoLanche']=="Todos"){
    $sql = "select * from itens where status='Ativo' AND nome like '%".$nome."%' ORDER BY nome";

    $resultado = $conexao->consulta($sql);

    if(count($resultado)==0){
      echo "<h2>Nenhum resultado para a pesquisa!</h2>";
    }
    if($resultado){
      foreach ($resultado as $item) {
        $resul = mysqli_query($mysqli,"SELECT id_residuo FROM item_residuo WHERE id_item = ".$item["id"]);
        $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);



        echo "<div class='col-md-4 col-sm-12 col-xs-12 col-lg-3 itens'>";

        echo '<div class="card hovercard">';
        if(!isset($_SESSION['tipo'])){
          echo '';
        }
        elseif ($_SESSION['tipo']==1) {
          echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
        }
        elseif ($_SESSION['tipo']==2) {
          echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
        }
        echo '<div class="card-background">
        <img class="card-bkimg" alt="" src="">
        </div>
        <div class="useravatar">
        <img alt="" src="'.$item["img"].'">
        </div>
        <div class="card-info"> <span class="card-title">'.$item["nome"].'</span>

        </div>
        </div>

        <div class="well">
        <div class="tab-content">
        <button type="button" id="stars" class="but but-shadow but-rc toggle1 selected" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
        <div class="hidden-xs">Detalhes</div>
        </button>
        <button type="button" id="favorites" class="but but-shadow but-rc toggle2" data-toggle="tab"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        <div class="hidden-xs">Resíduos</div>
        </button>

        <div class="tab-pane fade in active aba" id="tab1">
        <br>
        <p>Fornecedor: '.$item["marca"].'</p>
        <p>Desc. Nutricional: '.$item["desc_nutri"].'</p>
        <p>'.$item["quantidade"].' '.$item["uni_med"].'</p>
        </div>
        <div class="tab-pane fade in tab2" id="tab2">
        <br>';
        foreach ($relacao as $nomeResi) {
          $resi = mysqli_query($mysqli,"SELECT nome FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
          $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);
          echo '<p>'.$resicao[0]["nome"].'</p>';
        }
        echo '
        </div>
        </div>';

        echo '</div>';

        echo "</div>";
        }
}
}


if ($_POST['tipoLanche']=="Comida"){
$sql = "select * from itens where status='Ativo' AND tipo='Comida' AND nome like '%".$nome."%' ORDER BY nome";

$resultado = $conexao->consulta($sql);

if(count($resultado)==0){
  echo "<h2>Nenhum resultado para a pesquisa!</h2>";
}
if($resultado){
  foreach ($resultado as $item) {
    $resul = mysqli_query($mysqli,"SELECT id_residuo FROM item_residuo WHERE id_item = ".$item["id"]);
    $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);



    echo "<div class='col-md-4 col-sm-12 col-xs-12 col-lg-3 itens'>";

    echo '<div class="card hovercard">';
    if(!isset($_SESSION['tipo'])){
      echo '';
    }
    elseif ($_SESSION['tipo']==1) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    elseif ($_SESSION['tipo']==2) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    echo '<div class="card-background">
    <img class="card-bkimg" alt="" src="">
    </div>
    <div class="useravatar">
    <img alt="" src="'.$item["img"].'">
    </div>
    <div class="card-info"> <span class="card-title">'.$item["nome"].'</span>

    </div>
    </div>

    <div class="well">
    <div class="tab-content">
    <button type="button" id="stars" class="but but-shadow but-rc toggle1 selected" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
    <div class="hidden-xs">Detalhes</div>
    </button>
    <button type="button" id="favorites" class="but but-shadow but-rc toggle2" data-toggle="tab"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    <div class="hidden-xs">Resíduos</div>
    </button>

    <div class="tab-pane fade in active aba" id="tab1">
    <br>
    <p>Fornecedor: '.$item["marca"].'</p>
    <p>Desc. Nutricional: '.$item["desc_nutri"].'</p>
    <p>'.$item["quantidade"].' '.$item["uni_med"].'</p>
    </div>
    <div class="tab-pane fade in tab2" id="tab2">
    <br>';
    foreach ($relacao as $nomeResi) {
      $resi = mysqli_query($mysqli,"SELECT nome FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
      $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);
      echo '<p>'.$resicao[0]["nome"].'</p>';
    }
    echo '
    </div>
    </div>';

    echo '</div>';

    echo "</div>";
    }
}
}

if ($_POST['tipoLanche']=="Fruta"){
$sql = "select * from itens where status='Ativo' AND tipo='Fruta' AND nome like '%".$nome."%' ORDER BY nome";

$resultado = $conexao->consulta($sql);

if(count($resultado)==0){
  echo "<h2>Nenhum resultado para a pesquisa!</h2>";
}
if($resultado){
  foreach ($resultado as $item) {
    $resul = mysqli_query($mysqli,"SELECT id_residuo FROM item_residuo WHERE id_item = ".$item["id"]);
    $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);



    echo "<div class='col-md-4 col-sm-12 col-xs-12 col-lg-3 itens'>";

    echo '<div class="card hovercard">';
    if(!isset($_SESSION['tipo'])){
      echo '';
    }
    elseif ($_SESSION['tipo']==1) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    elseif ($_SESSION['tipo']==2) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    echo '<div class="card-background">
    <img class="card-bkimg" alt="" src="">
    </div>
    <div class="useravatar">
    <img alt="" src="'.$item["img"].'">
    </div>
    <div class="card-info"> <span class="card-title">'.$item["nome"].'</span>

    </div>
    </div>

    <div class="well">
    <div class="tab-content">
    <button type="button" id="stars" class="but but-shadow but-rc toggle1 selected" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
    <div class="hidden-xs">Detalhes</div>
    </button>
    <button type="button" id="favorites" class="but but-shadow but-rc toggle2" data-toggle="tab"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    <div class="hidden-xs">Resíduos</div>
    </button>

    <div class="tab-pane fade in active aba" id="tab1">
    <br>
    <p>Fornecedor: '.$item["marca"].'</p>
    <p>Desc. Nutricional: '.$item["desc_nutri"].'</p>
    <p>'.$item["quantidade"].' '.$item["uni_med"].'</p>
    </div>
    <div class="tab-pane fade in tab2" id="tab2">
    <br>';
    foreach ($relacao as $nomeResi) {
      $resi = mysqli_query($mysqli,"SELECT nome FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
      $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);
      echo '<p>'.$resicao[0]["nome"].'</p>';
    }
    echo '
    </div>
    </div>';

    echo '</div>';

    echo "</div>";
    }
}
}


if ($_POST['tipoLanche']=="Bebida"){
$sql = "select * from itens where status='Ativo' AND tipo='Bebida' AND nome like '%".$nome."%' ORDER BY nome";

$resultado = $conexao->consulta($sql);

if(count($resultado)==0){
  echo "<h2>Nenhum resultado para a pesquisa!</h2>";
}
if($resultado){
  foreach ($resultado as $item) {
    $resul = mysqli_query($mysqli,"SELECT id_residuo FROM item_residuo WHERE id_item = ".$item["id"]);
    $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);



    echo "<div class='col-md-4 col-sm-12 col-xs-12 col-lg-3 itens'>";

    echo '<div class="card hovercard">';
    if(!isset($_SESSION['tipo'])){
      echo '';
    }
    elseif ($_SESSION['tipo']==1) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    elseif ($_SESSION['tipo']==2) {
      echo "<a id='botaoEdit' class='glyphicon glyphicon-cog edit' href='editarItem.php?id=".$item["id"]."'></a>";
    }
    echo '<div class="card-background">
    <img class="card-bkimg" alt="" src="">
    </div>
    <div class="useravatar">
    <img alt="" src="'.$item["img"].'">
    </div>
    <div class="card-info"> <span class="card-title">'.$item["nome"].'</span>

    </div>
    </div>

    <div class="well">
    <div class="tab-content">
    <button type="button" id="stars" class="but but-shadow but-rc toggle1 selected" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
    <div class="hidden-xs">Detalhes</div>
    </button>
    <button type="button" id="favorites" class="but but-shadow but-rc toggle2" data-toggle="tab"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    <div class="hidden-xs">Resíduos</div>
    </button>

    <div class="tab-pane fade in active aba" id="tab1">
    <br>
    <p>Fornecedor: '.$item["marca"].'</p>
    <p>Desc. Nutricional: '.$item["desc_nutri"].'</p>
    <p>'.$item["quantidade"].' '.$item["uni_med"].'</p>
    </div>
    <div class="tab-pane fade in tab2" id="tab2">
    <br>';
    foreach ($relacao as $nomeResi) {
      $resi = mysqli_query($mysqli,"SELECT nome FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
      $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);
      echo '<p>'.$resicao[0]["nome"].'</p>';
    }
    echo '
    </div>
    </div>';

    echo '</div>';

    echo "</div>";
    }
}
}



}


?>

</body>

</html>
