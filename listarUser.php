<!DOCTYPE html>
<html>
<?php
session_start();
if($_SESSION['tipo']!==1){
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
              <h1>Usuários Listados</h1>
              <!--<input type="text" class="input-search" alt="lista-clientes" placeholder="Buscar usuários cadastrados" />
              <span class="bar"></span>-->
							<br>
              <?php

                 $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                 $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios ORDER BY nome");
                 $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                 if(count($usuarios)==0){
                 echo "Não há usuários cadastrados.";
                 }else{
                   echo '<table class="lista-clientes">';
                   echo "<thead>";
                   echo "<tr>";
                   echo "<th> Nome </th>";
                   echo "<th> Sobrenome </th>";
                   echo "<th> Nome Login </th>";
                   echo "<th> Função </th>";
                   echo "<th> Email </th>";
                   echo "<th> Telefone </th>";
                   echo "<th> Status </th>";
                   echo "<th>  </th>";
                   echo "</tr>";
                   echo "</thead>";
                   echo "<tbody>";
                      foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>".$usuario["nome"]."</td>";
                        echo "<td>".$usuario["sobrenome"]."</td>";
                        echo "<td>".$usuario["nome_log"]."</td>";
                        echo "<td>".$usuario["funcao"]."</td>";
                        echo "<td>".$usuario["email"]."</td>";
                        echo "<td>".$usuario["telefone"]."</td>";
                        echo "<td>".$usuario["status"]."</td>";
                        echo "<td><a href='editarUser.php?id=".$usuario["ID"]."'>Editar</a>";


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
