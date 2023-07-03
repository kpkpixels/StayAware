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

      $(function(){
        $("#search").click(
          function () {
            $(".av").show(500);
          });

        });
</script>


    <div class="row">

      <div class="col-md-8 col-sm-6 col-xs-12">

        <input title="Insira o nome do item desejado" class="input" id="search" name="nome" placeholder="Pesquisar" type="text">
        <button id="botaoPesquisaItem"><span class="glyphicon glyphicon-search"></span></button>
        <br>
        <br>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="av" style="display:none;">
            <h5 title="Filtrar pesquisa por um tipo de item" id="spanfiltro">Categoria</h5>
            <div class="select-style selectfiltro">
              <select class="selectaba" name="tipoLanche" id="filtroTipo" >
                <option id="1" value="Todos">Todas</option>
                <option id="2" value="Comida">Comida</option>
                <option id="3" value="Bebida">Bebida</option>
                <option id="4" value="Fruta">Fruta</option>
              </select>
            </div>
        <br>
      </div>

        <br>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">


      </div>


      <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 pesquisar">

        <?php

        $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
        $resultado = mysqli_query($mysqli,"SELECT * FROM itens WHERE status='Ativo' ORDER BY nome");
        $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


        if(count($itens)==0){
          echo "<h2>Nenhum resultado para a pesquisa!</h2>";
        }
        else{

          foreach ($itens as $item) {
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
            <p class="reticencias">Fornecedor: '.$item["marca"].'</p>
            <p class="reticencias">Desc. Nutricional: '.$item["desc_nutri"].'</p>
            <p class="reticencias">'.$item["quantidade"].' '.$item["uni_med"].'</p>
            </div>
            <div class="tab-pane fade in tab2" id="tab2">
            <br>';
            foreach ($relacao as $nomeResi) {
              $resi = mysqli_query($mysqli,"SELECT nome FROM residuos WHERE id = ".$nomeResi["id_residuo"]);
              $resicao = mysqli_fetch_all($resi, MYSQLI_ASSOC);
              echo '<p class="reticencias">'.$resicao[0]["nome"].'</p>';
            }
            echo '
            </div>
            </div>';

            echo '</div>';

            echo "</div>";
          }

        }

        ?>
      </div>
    </div>



    <!-- Footer -->
    <footer>
      <div class="row">
        <div class="col-md-12">
          <hr>
          <p>Copyright &copy; Fique Esperto 2016</p>
        </div>
      </div>
      <!-- /.row -->
    </footer>

  </div>
  <!-- /.container -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
