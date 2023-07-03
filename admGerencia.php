<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['tipo'])){
  session_destroy();

	header("location:index.php");
}

?>
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



        <div class="row">

            <div class="col-lg-2">
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
          <div class="col-lg-9">

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
