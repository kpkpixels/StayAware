<!DOCTYPE html>
<html>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/funcoes.js" type="text/javascript"></script>

<?php
session_start();
if(!isset($_SESSION['tipo'])){
  session_destroy();

	header("location:index.php");
}

?>
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


        <div class="row">
          <div style="overflow-x:auto;" class="col-md-12">
              <h1>Itens Listados</h1>

                <div class="col-md-3 col-sm-12 col-xs-12">
                  <input class="input pesquisaItem" id="searchAdm" name="nome" placeholder="Pesquisar" type="text">
                  <button id="botaoPesquisaItemAdm"><span class="glyphicon glyphicon-search"></span></button>
                  <br>
                  <br>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <h5 id="spanfiltro">Filtrar por</h5>
                  <div class="select-style selectfiltro">
                    <select class="selectaba" name="itemOuFornecedor" id="filtroAdm" >
                      <option  value="Fornecedor">Fornecedor</option>
                      <option  value="Item">Item</option>
                    </select>
                  </div>
                  <br>
                  <br>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12" id="filtroTipoAdm" style="display:none;">
                                  <h5 id="spanfiltro"> Qual tipo     </h5>
                                  <div class="select-style selectfiltro">
                                    <select class="selectaba" name="tipoLanche" id="tipoAdm"  >
                                      <option  value="Todos">Todos</option>
                                      <option  value="Comida">Comida</option>
                                      <option  value="Bebida">Bebida</option>
                                      <option  value="Fruta">Fruta</option>
                                    </select>
                                  </div>
                                  <br>
                                  <br>
                </div>
                <!-- teste de mais filtros -->
                <div class="col-md-3 col-sm-3 col-xs-12"id="filtroStatusAdm" style="display:none;">
                                <h5 id="spanfiltro">Escolha status</h5>
                                <div class="select-style selectfiltro">
                                  <select class="selectaba" name="statusLanche" id="statusAdm" >
                                    <option  value="Todos">Todos</option>
                                    <option  value="Ativo">Ativo</option>
                                    <option  value="Inativo">Inativo</option>

                                  </select>
                                </div>
                                <br>
                                <br>
                </div>

              <?php

                 $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                 $resultado = mysqli_query($mysqli,"SELECT * FROM itens ORDER BY nome");
                 $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


                 if(count($itens)==0){
                 echo "Não há itens cadastrados.";
                 }else{

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
                      foreach ($itens as $item) {
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

            ?>

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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>

    </script>

</body>

</html>
