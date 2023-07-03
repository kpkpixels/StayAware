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
include_once "./BD/MySQL.class.php";
$conexao = new MySQL();
$mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
$resultado = mysqli_query($mysqli,"SELECT * FROM itens");
$itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


if(isset($_POST['nome'])){
  $nome = $_POST['nome'];

//ate aqui vem
  if ($_POST["quem"]=="Fornecedor"){

    $sql = "select * from itens where marca like '%".$nome."%' ORDER BY nome";

    $resultado = $conexao->consulta($sql);

    if(count($resultado)==0){
      echo "<h2>Nenhum resultado para a pesquisa!</h2>";
    }
    if($resultado){
      echo '<table class="lista-clientes">';
      echo "<thead>";
      echo "<tr>";
      echo "<th> Nome </th>";
      echo "<th> Fornecedor </th>";
      echo "<th> Quantidade </th>";
      echo "<th> Unidade de medida </th>";
      echo "<th> Descrição nutricional </th>";
      echo "<th> Tipo </th>";
      echo "<th> Quantidade de resíduos </th>";
      echo "<th> Status </th>";
      echo "<th>  </th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($resultado as $item) {
        echo "<tr>";
        echo "<td>".$item["nome"]."</td>";
        echo "<td>".$item["marca"]."</td>";
        echo "<td>".$item["quantidade"]."</td>";
        echo "<td>".$item["uni_med"]."</td>";
        echo "<td>".$item["desc_nutri"]."</td>";
        echo "<td>".$item["tipo"]."</td>";
        echo "<td>".$item["quant_resi"]."</td>";
        echo "<td>".$item["status"]."</td>";
        echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</tr>";

    }
  }

  //////////////////////////////////////////////////////acabou fornecedor//////////////////

  if ($_POST["quem"]=="Item"){

$tipo = $_POST["tipoLanche"];
$status = $_POST["statusLanche"];
/////////////tudo pra status "todos" //////////////////

    if($_POST["statusLanche"]=="Todos"){


      if ($_POST['tipoLanche']=="Todos"){
        $sql = "select * from itens where nome like '%".$nome."%' ORDER BY nome";

        $resultado = $conexao->consulta($sql);

        if(count($resultado)==0){
          echo "<h2>Nenhum resultado para a pesquisa!</h2>";
        }
        if($resultado){
          echo '<table class="lista-clientes">';
          echo "<thead>";
          echo "<tr>";
          echo "<th> Nome </th>";
          echo "<th> Fornecedor </th>";
          echo "<th> Quantidade </th>";
          echo "<th> Unidade de medida </th>";
          echo "<th> Descrição nutricional </th>";
          echo "<th> Tipo </th>";
          echo "<th> Quantidade de resíduos </th>";
          echo "<th> Status </th>";
          echo "<th>  </th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach ($resultado as $item) {
            echo "<tr>";
            echo "<td>".$item["nome"]."</td>";
            echo "<td>".$item["marca"]."</td>";
            echo "<td>".$item["quantidade"]."</td>";
            echo "<td>".$item["uni_med"]."</td>";
            echo "<td>".$item["desc_nutri"]."</td>";
            echo "<td>".$item["tipo"]."</td>";
            echo "<td>".$item["quant_resi"]."</td>";
            echo "<td>".$item["status"]."</td>";
            echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          echo "</tr>";

        }
      } ///todos tipos de item
 else{
      $sql = "select * from itens where tipo='$tipo' and nome like '%".$nome."%' ORDER BY nome";

      $resultado = $conexao->consulta($sql);

      if(count($resultado)==0){
        echo "<h2>Nenhum resultado para a pesquisa!</h2>";
      }
      if($resultado){
        echo '<table class="lista-clientes">';
        echo "<thead>";
        echo "<tr>";
        echo "<th> Nome </th>";
        echo "<th> Fornecedor </th>";
        echo "<th> Quantidade </th>";
        echo "<th> Unidade de medida </th>";
        echo "<th> Descrição nutricional </th>";
        echo "<th> Tipo </th>";
        echo "<th> Quantidade de resíduos </th>";
        echo "<th> Status </th>";
        echo "<th>  </th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($resultado as $item) {
          echo "<tr>";
          echo "<td>".$item["nome"]."</td>";
          echo "<td>".$item["marca"]."</td>";
          echo "<td>".$item["quantidade"]."</td>";
          echo "<td>".$item["uni_med"]."</td>";
          echo "<td>".$item["desc_nutri"]."</td>";
          echo "<td>".$item["tipo"]."</td>";
          echo "<td>".$item["quant_resi"]."</td>";
          echo "<td>".$item["status"]."</td>";
          echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</tr>";

      }
    }
}
      else{
        if ($_POST['tipoLanche']=="Todos"){
          $sql = "select * from itens where status='$status' and nome like '%".$nome."%' ORDER BY nome";

          $resultado = $conexao->consulta($sql);

          if(count($resultado)==0){
            echo "<h2>Nenhum resultado para a pesquisa!</h2>";
          }
          if($resultado){
            echo '<table class="lista-clientes">';
            echo "<thead>";
            echo "<tr>";
            echo "<th> Nome </th>";
            echo "<th> Fornecedor </th>";
            echo "<th> Quantidade </th>";
            echo "<th> Unidade de medida </th>";
            echo "<th> Descrição nutricional </th>";
            echo "<th> Tipo </th>";
            echo "<th> Quantidade de resíduos </th>";
            echo "<th> Status </th>";
            echo "<th>  </th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($resultado as $item) {
              echo "<tr>";
              echo "<td>".$item["nome"]."</td>";
              echo "<td>".$item["marca"]."</td>";
              echo "<td>".$item["quantidade"]."</td>";
              echo "<td>".$item["uni_med"]."</td>";
              echo "<td>".$item["desc_nutri"]."</td>";
              echo "<td>".$item["tipo"]."</td>";
              echo "<td>".$item["quant_resi"]."</td>";
              echo "<td>".$item["status"]."</td>";
              echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</tr>";

          }



}
        else{
        $sql = "select * from itens where status='$status' and tipo='$tipo' and nome like '%".$nome."%' ORDER BY nome";

        $resultado = $conexao->consulta($sql);

        if(count($resultado)==0){
          echo "<h2>Nenhum resultado para a pesquisa!</h2>";
        }
        if($resultado){
          echo '<table class="lista-clientes">';
          echo "<thead>";
          echo "<tr>";
          echo "<th> Nome </th>";
          echo "<th> Fornecedor </th>";
          echo "<th> Quantidade </th>";
          echo "<th> Unidade de medida </th>";
          echo "<th> Descrição nutricional </th>";
          echo "<th> Tipo </th>";
          echo "<th> Quantidade de resíduos </th>";
          echo "<th> Status </th>";
          echo "<th>  </th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach ($resultado as $item) {
            echo "<tr>";
            echo "<td>".$item["nome"]."</td>";
            echo "<td>".$item["marca"]."</td>";
            echo "<td>".$item["quantidade"]."</td>";
            echo "<td>".$item["uni_med"]."</td>";
            echo "<td>".$item["desc_nutri"]."</td>";
            echo "<td>".$item["tipo"]."</td>";
            echo "<td>".$item["quant_resi"]."</td>";
            echo "<td>".$item["status"]."</td>";
            echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          echo "</tr>";

        }
      }
      }
    //status todos
//outros status


  }
  //////////////fim do filtro pra item //////////////////////


} /////fim






/*

if(isset($_POST['nome'])){
  $nome = $_POST['nome'];

  if ($_POST['tipoLanche']=="Fruta"){
    $sql = "select * from itens where tipo='Fruta' AND nome like '%".$nome."%' ORDER BY nome";

    $resultado = $conexao->consulta($sql);

    if(count($resultado)==0){
      echo "<h2>Nenhum resultado para a pesquisa!</h2>";
    }
    if($resultado){
      echo '<table class="lista-clientes">';
      echo "<thead>";
      echo "<tr>";
      echo "<th> Nome </th>";
      echo "<th> Fornecedor </th>";
      echo "<th> Quantidade </th>";
      echo "<th> Unidade de medida </th>";
      echo "<th> Descrição nutricional </th>";
      echo "<th> Tipo </th>";
      echo "<th> Quantidade de resíduos </th>";
      echo "<th> Status </th>";
      echo "<th>  </th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($resultado as $item) {
        echo "<tr>";
        echo "<td>".$item["nome"]."</td>";
        echo "<td>".$item["marca"]."</td>";
        echo "<td>".$item["quantidade"]."</td>";
        echo "<td>".$item["uni_med"]."</td>";
        echo "<td>".$item["desc_nutri"]."</td>";
        echo "<td>".$item["tipo"]."</td>";
        echo "<td>".$item["quant_resi"]."</td>";
        echo "<td>".$item["status"]."</td>";
        echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</tr>";

    }
  }
}

if(isset($_POST['nome'])){
  $nome = $_POST['nome'];

  if ($_POST['tipoLanche']=="Bebida"){
    $sql = "select * from itens where tipo='Bebida' AND nome like '%".$nome."%' ORDER BY nome";

    $resultado = $conexao->consulta($sql);

    if(count($resultado)==0){
      echo "<h2>Nenhum resultado para a pesquisa!</h2>";
    }
    if($resultado){
      echo '<table class="lista-clientes">';
      echo "<thead>";
      echo "<tr>";
      echo "<th> Nome </th>";
      echo "<th> Fornecedor </th>";
      echo "<th> Quantidade </th>";
      echo "<th> Unidade de medida </th>";
      echo "<th> Descrição nutricional </th>";
      echo "<th> Tipo </th>";
      echo "<th> Quantidade de resíduos </th>";
      echo "<th> Status </th>";
      echo "<th>  </th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($resultado as $item) {
        echo "<tr>";
        echo "<td>".$item["nome"]."</td>";
        echo "<td>".$item["marca"]."</td>";
        echo "<td>".$item["quantidade"]."</td>";
        echo "<td>".$item["uni_med"]."</td>";
        echo "<td>".$item["desc_nutri"]."</td>";
        echo "<td>".$item["tipo"]."</td>";
        echo "<td>".$item["quant_resi"]."</td>";
        echo "<td>".$item["status"]."</td>";
        echo "<td><a href='editarItem.php?id=".$item["id"]."'>Editar</a>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</tr>";

    }
  }


}

*/



?>
</html>
