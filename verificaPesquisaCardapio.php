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

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/funcoes.js" type="text/javascript"></script>

<?php
include_once "./BD/MySQL.class.php";
$conexao = new MySQL();
$mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
$resultado = mysqli_query($mysqli,"SELECT * FROM itens");
$itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);



if(isset($_POST['nome'])){

  $idItem = $_POST['nome'];

  $sqlNome = "select nome from itens where id = $idItem";
  $resultadoNome = $conexao->consulta($sqlNome);

  echo "<hr>
  <h3>Cardápios com ".$resultadoNome[0]['nome']."<h3>";

  $sql = "select * from cardapios where id in (select id_cardapio from cardapio_item where id_item = $idItem)";

  $resultado = $conexao->consulta($sql);

  if(count($resultado)==0){
    echo "<h4>Nenhum resultado para a pesquisa!</h4>";
  }

  if($resultado){

    foreach ($resultado as $cardapio) {

      $data = date('d-m-Y', strtotime($cardapio["dia"]));

      $datan = str_replace('-','/',$data);



      echo '<div  class="col-md-4 col-sm-12 col-xs-12 col-lg-3">';

      echo '<div class="card hovercard">';
      if(!isset($_SESSION['tipo'])){
        echo '';
      }
      elseif (isset($_SESSION['tipo'])) {
        echo '<a id="botaoEdit" class="glyphicon glyphicon-cog edit" href="editarCardapio.php?id='.$cardapio["id"].'"></a>';
      }
      echo '<a href="cardapio.php?id='.$cardapio["id"].'"><div class="card-background">
      <img class="card-bkimg" alt="" src="img/prototipo.png">
      </div></a>
      <div class="card-info"> <span class="titulo">'.$datan.'<br> Turno: '.$cardapio["turno"].'</span> </div>
      </div>
      </div>';

    }

  }

} //por item

if(isset($_POST['dia1'])){
  $dia = date('d-m-Y', strtotime($_POST['dia1']));
  $diat = str_replace('-','/',$dia);
  $dia1 = $_POST['dia1'];


  if($_POST['dia2']!=""){
    $dia = date('d-m-Y', strtotime($_POST['dia1']));
    $diat = str_replace('-','/',$dia);

    $diaC = date('d-m-Y', strtotime($_POST['dia2']));
    $diat2 = str_replace('-','/',$diaC);

    echo "<hr>
    <h3>Resultado para o intervalo: ".$diat." até ".$diat2."<h3>";

    $dia2 = $_POST['dia2'];

    $sql = "select * from cardapios where dia between '".$dia1."' AND '".$dia2."' order by dia";

    $resultado = $conexao->consulta($sql);

    if(count($resultado)==0){
      echo "<h4>Nenhum resultado para a pesquisa!</h4>";
    }

    if($resultado){

      foreach ($resultado as $cardapio) {

        $data = date('d-m-Y', strtotime($cardapio["dia"]));

        $datan = str_replace('-','/',$data);



        echo '<div  class="col-md-4 col-sm-12 col-xs-12 col-lg-3">';

        echo '<div class="card hovercard">';
        if(!isset($_SESSION['tipo'])){
          echo '';
        }
        elseif (isset($_SESSION['tipo'])) {
          echo '<a id="botaoEdit" class="glyphicon glyphicon-cog edit" href="editarCardapio.php?id='.$cardapio["id"].'"></a>';
        }
        echo '<a href="cardapio.php?id='.$cardapio["id"].'"><div class="card-background">
        <img class="card-bkimg" alt="" src="img/prototipo.png">
        </div></a>
        <div class="card-info"> <span class="titulo">'.$datan.'<br> Turno: '.$cardapio["turno"].'</span> </div>
        </div>
        </div>';

      }

    }

  }//ve se é intervalo

  else {
    echo "<hr>
    <h3>Resultado para o dia: ".$diat."<h3>";



        $sql = "select * from cardapios where dia ='".$dia1."'";

        $resultado = $conexao->consulta($sql);

        if(count($resultado)==0){
          echo "<h4>Nenhum resultado para a pesquisa!</h4>";
        }

        if($resultado){

          foreach ($resultado as $cardapio) {

            $data = date('d-m-Y', strtotime($cardapio["dia"]));

            $datan = str_replace('-','/',$data);



            echo '<div  class="col-md-4 col-sm-12 col-xs-12 col-lg-3">';

            echo '<div class="card hovercard">';
            if(!isset($_SESSION['tipo'])){
              echo '';
            }
            elseif (isset($_SESSION['tipo'])) {
              echo '<a id="botaoEdit" class="glyphicon glyphicon-cog edit" href="editarCardapio.php?id='.$cardapio["id"].'"></a>';
            }
            echo '<a href="cardapio.php?id='.$cardapio["id"].'"><div class="card-background">
            <img class="card-bkimg" alt="" src="img/prototipo.png">
            </div></a>
            <div class="card-info"> <span class="titulo">'.$datan.'<br> Turno: '.$cardapio["turno"].'</span> </div>
            </div>
            </div>';

          }

        }
  }
}//ve se é o parametro de datas

?>

</html>
