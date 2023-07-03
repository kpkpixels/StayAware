<!DOCTYPE html>
<html>
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
              <h1>Cardápios Listados</h1>
              <!--<input type="text" class="input-search" alt="lista-clientes" placeholder="Buscar usuários cadastrados" />
              <span class="bar"></span>-->
              <br>
              <?php

                 $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                 $resultado = mysqli_query($mysqli,"SELECT * FROM cardapios ORDER BY dia DESC");
                 $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                 if(count($cardapios)==0){
                 echo "Não há resíduos cadastrados.";
                 }else{
                   echo '<table class="lista-clientes">';
                   echo "<thead>";
                   echo "<tr>";
                   echo "<th> Dia </th>";
                   echo "<th> Turno </th>";
                   echo "<th> Quantidade de itens </th>";
                   echo "<th>  </th>";
                   echo "</tr>";
                   echo "</thead>";
                   echo "<tbody>";
                      foreach ($cardapios as $cardapio) {
                        $data = date('d-m-Y', strtotime($cardapio["dia"]));

                        $datan = str_replace('-','/',$data);
                        echo "<tr>";
                        echo "<td>".$datan."</td>";
                        echo "<td>".$cardapio["turno"]."</td>";
                        echo "<td>".$cardapio["quant_item"]."</td>";
                        echo "<td><a href='editarCardapio.php?id=".$cardapio["id"]."'>Editar</a>";


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
