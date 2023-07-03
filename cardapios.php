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
      $(".selectaba").change(function(){
        if( $(this).val() == "Item"){
          $(".av").show(500);
          $(".av2").hide(500);
        }
      });
    });
    $(function(){
      $(".selectaba").change(function(){
        if( $(this).val() == "Data"){
          $(".av2").show(500);
          $(".av").hide(500);
        }
      });
    });
    $(function(){
      $(".selectaba").change(function(){
        if( $(this).val() == "Selecione"){
          $(".av2").hide(500);
          $(".av").hide(500);
        }
      });
    });
    $(function(){
      $('#datetimepicker1').datetimepicker({
        format: 'dd/MM/yyyy',
        language: 'pt-BR'
      });
      $('#datetimepicker2').datetimepicker({
        format: 'dd/MM/yyyy',
        language: 'pt-BR'
      });
      $.fn.datetimepicker.defaults = {
        maskInput: true           // disables the text input mask
      };
    });
    </script>


    <div class="row">

      <div class="col-md-8 col-sm-6 col-xs-12">

        <h5 title="Filtrar pesquisa por uma categoria" id="spanfiltro">Filtrar por</h5>
        <div class="select-style selectfiltro">
          <select class="selectaba" name="catPesquisa" id="catPesquisa" >
            <option value="Selecione">Selecione...</option>
            <option value="Item">Item</option>
            <option value="Data">Data</option>

          </select>
        </div>
        <br>
        <br>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="av" style="display:none;">
          <h5 title="Filtrar pesquisa por um item" id="spanfiltro">Item</h5>
          <div class="select-style selectfiltro">
            <select class="selectaba" name="itemCardapio" id="filtroItem" >
              <?php

              $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
              $resultado = mysqli_query($mysqli,"SELECT * FROM itens WHERE status='Ativo'");
              $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

              if(count($itens)==0){
                echo " ";
              }
              else{

                foreach ($itens as $item) {
                  echo "<option value=".$item["id"].">".$item["nome"]."</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>


        <div class="col-md-12 col-xs-12 col-sm-12">
          <div class="av2" style="display:none;">
            <h5> Pesquise no campo "Dia 1" para pesquisar uma data e nos dois campos para pesquisar um intervalo</h5>
            <div class="group col-md-2 col-sm-3 col-xs-12">
              <span id="spanselect">Dia 1</span>
              <div id="datetimepicker1" class="input-append date">

                <span class="add-on">
                  <input name="dataCardapio" type="date" id="dataCardapio1" autocomplete="off" placeholder="--/--/----"style="width:200px" required></input>
                </span>
              </div>
            </div>

            <div class="group col-md-2 col-sm-3 col-xs-12">
              <span id="spanselect">Dia 2</span>
              <div id="datetimepicker2" class="input-append date">

                <span class="add-on">
                  <input name="dataCardapio" type="date" id="dataCardapio2" autocomplete="off" placeholder="--/--/----"style="width:200px" required></input>
                </span>
              </div>
            </div>

          </div>

          <br>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 pesquisar">
        <h3>Cardápios próximos<h3>
          <?php

          $dataAtual = date('Y-m-d');

          $data3 = date('Y-m-d', strtotime($dataAtual . ' +3 days'));

          $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
          $resultado = mysqli_query($mysqli,"SELECT * from cardapios where dia between '$dataAtual' and '$data3' ORDER BY dia");
          $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

          if(count($cardapios)==0){
            echo "<h4>Nenhum cardápio próximo!</h2>";
          }
          else{

            foreach ($cardapios as $cardapio) {

              $data = date('d-m-Y', strtotime($cardapio["dia"]));

              $datan = str_replace('-','/',$data);

              echo '<div  class="col-md-4 col-sm-6 col-xs-12 col-lg-3">';

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



          ?>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <hr>
          <h3>Todos os cardápios<h3>
            <?php

            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
            $resultado = mysqli_query($mysqli,"SELECT * FROM cardapios ORDER BY dia DESC");
            $cardapios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


            if(count($cardapios)==0){
              echo "<h2>Nenhum resultado para a pesquisa!</h2>";
            }
            else{

              foreach ($cardapios as $cardapio) {

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
