<!DOCTYPE html>

<html>
<?php
include_once "navbar.php";
 ?>
                <ul class="nav navbar-nav">
                  <li>
                  <a id="linkbarra" class="acessado" href=index.php>Início</a>
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

    <!-- Half Page Image Background Carousel Header -->
    <header style="padding-top: 40px; padding-bottom: 30px;" id="myCarousel" class="carousel slide">
        <!-- Indicators -->

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
        <!-- Wrapper for Slides -->
        <div class="carousel-inner" style="padding-bottom: 20px;padding-top:20px;">

          <?php

          $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');

          $resultado = mysqli_query($mysqli,"SELECT * FROM cardapios ORDER BY dia ASC");
          $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

          $resultadomanha = mysqli_query($mysqli,"SELECT * FROM cardapios WHERE turno='Manhã' OR turno='Ambos' ORDER BY dia ASC");
          $manhas = mysqli_fetch_all($resultadomanha, MYSQLI_ASSOC);

          $resultadotarde = mysqli_query($mysqli,"SELECT * FROM cardapios WHERE turno='Tarde' OR turno='Ambos' ORDER BY dia ASC");
          $tardes = mysqli_fetch_all($resultadotarde, MYSQLI_ASSOC);

          $horaAtual = date('H:i');

          if(count($cardapios)==0){
            echo "<h2>Não há cardapios resultado para a pesquisa!</h2>";
          }
          else{
            if ($horaAtual<'12:15'){
              echo'
              <div>
                    <div id="turnoselect"  class="av">
                        <h5 title="Filtrar pesquisa por um tipo de item" id="spanfiltro">Turno</h5>
                        <div class="select-style selectfiltro">
                          <select class="selectaba" name="turno" id="filtroTurno" >
                            <option id="1" value="Manha">Manhã</option>
                            <option id="2" value="Tarde">Tarde</option>
                          </select>
                        </div>
                    <br>
                  </div>
                    <br>
              </div>';

              foreach ($manhas as $manha) {

                  $resul = mysqli_query($mysqli,"SELECT id_item FROM cardapio_item WHERE id_cardapio = ".$manha["id"]);
                  $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);

                  $data = date('d-m-Y', strtotime($manha["dia"]));

                  $datan = str_replace('-','/',$data);

                  $dataAtual = date('d/m/Y');

                  if ($datan==$dataAtual){

                    echo '
                        <div class="item active">

                          <h1 style="text-align: center"> Cardápio do dia '.$datan.' </h2>';

                      echo '<h1 style="text-align: center"> Manhã </h2>';

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

                      echo '</div>';
                      }
                  else{
                    echo '
                        <div class="item">

                          <h1 style="text-align: center"> Cardápio do dia '.$datan.' </h2>';

                      echo '<h1 style="text-align: center"> Manhã </h2>';

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

                      echo '</div>';
                  }
                }
            }

            if ($horaAtual>'12:15'){
              echo'
              <div>
                    <div id="turnoselect"  class="av">
                        <h5 title="Filtrar pesquisa por um tipo de item" id="spanfiltro">Turno</h5>
                        <div class="select-style selectfiltro">
                          <select class="selectaba" name="turno" id="filtroTurno" >
                            <option id="1" value="Manha">Manhã</option>
                            <option id="2" value="Tarde" selected>Tarde</option>
                          </select>
                        </div>
                    <br>
                  </div>
                    <br>
              </div>';

                foreach ($tardes as $tarde) {

                    $resul = mysqli_query($mysqli,"SELECT id_item FROM cardapio_item WHERE id_cardapio = ".$tarde["id"]);
                    $relacao = mysqli_fetch_all($resul, MYSQLI_ASSOC);

                    $data = date('d-m-Y', strtotime($tarde["dia"]));

                    $datan = str_replace('-','/',$data);

                    $dataAtual = date('d/m/Y');

                    if ($datan==$dataAtual){

                      echo '
                          <div class="item active">

                            <h1 style="text-align: center"> Cardápio do dia '.$datan.' </h2>';

                        echo '<h1 style="text-align: center"> Tarde </h2>';

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

                        echo '</div>';
                        }
                    else{
                      echo '
                          <div class="item">

                            <h1 style="text-align: center"> Cardápio do dia '.$datan.' </h2>';

                        echo '<h1 style="text-align: center"> Tarde </h2>';

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

                        echo '</div>';
                    }
                  }
              }
          }



          ?>

      </div>

        <!-- Controls -->
        <a1 class="left carousel-control" href="#myCarousel" style="cursor:pointer" data-slide="prev">
            <span class="icon-prev"></span>
        </a1>
        <a1 class="right carousel-control" href="#myCarousel" style="cursor:pointer" data-slide="next">
            <span class="icon-next"></span>
        </a1>

        <script  type="text/javascript">
        $(function(){
          $("#corSig").click(function(){
              $("#abaSig").slideToggle();
        });
      });
        </script>

    </header>

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


</body>

</html>
