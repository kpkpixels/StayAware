<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['tipo'])){
  session_destroy();
  header("location:index.php");
}

?>
<html>
<head>

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

<script  type="text/javascript">
$(function(){
  $(".selectaba").change(function(){


    if( $(this).val() == 1){
      $(".aba1").show(500);
      $(".aba2").hide(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 2){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 2){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").hide(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 3){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").hide(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 4){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").show(500);
      $(".aba5").hide(500);

    }
    if( $(this).val() == 5){
      $(".aba1").show(500);
      $(".aba2").show(500);
      $(".aba3").show(500);
      $(".aba4").show(500);
      $(".aba5").show(500);

    }


  });
});
</script>


<div class="row">

  <div class="col-md-2 col-sm-2 col-xs-12">
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

               <div class="col-md-10 col-sm-10 col-xs-12" >
                  <h1>Cadastrar item</h1>
                  <br>
                  <form name="formcadas" action='acoesItem.php' method='post' enctype="multipart/form-data">
                    <div class="group col-md-6">
                      <input type="text" name="nomeItem" maxlength="250" required>
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Nome</label>
                    </div>
                    <div class="group col-md-6">
                      <input type="text" name="marcaItem" maxlength="100" required>
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Fornecedor</label>
                    </div>
                    <div class="group col-md-3">
                      <span id="spanselect">Unidade de medida</span>
                      <div class="select-style">
                        <select name="unidadeItem" >
                          <option value="Litros">mL</option>
                          <option value="Mililitros">L</option>
                          <option value="Gramas">g</option>
                          <option value="Quilos">Kg</option>
                          <option value="Unidade">Unidade</option>
                        </select>
                      </div>
                    </div>
                    <div class="group col-md-6">
                      <input type="number" name="quantItem" required>
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Valor da unidade de medida</label>
                    </div>
                    <div class="group col-md-2">
                      <span id="spanselect">Tipo do item</span>
                      <div class="select-style">
                        <select class="selectaba" name="tipoItem" >
                          <option value="Comida">Comida</option>
                          <option value="Bebida">Bebida</option>
                          <option value="Fruta">Fruta</option>
                        </select>
                      </div>
                    </div>
                    <div class="group col-md-2">
                      <span id="spanselect">Quant. de resíduos</span>
                      <div class="select-style">
                        <select class="selectaba" name="resiItem" >
                          <option id="1" value="1">1</option>
                          <option id="2" value="2">2</option>
                          <option id="3" value="3">3</option>
                        <!--  <option id="4" value="4">4</option>-->
                        <!--  <option id="5" value="5">5</option>-->
                        </select>
                      </div>
                    </div>

                    <div class="group col-md-12 residuo">
                      <h4>Resíduos</h4>
                      <hr>
                      <div class="group col-md-2 aba1">
                        <span id="spanselect">Resíduo</span>
                        <div class="select-style">
                          <select name="nameresiItem" >
                            <?php

                            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                            $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE status='Ativo'");
                            $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                            if(count($residuos)==0){
                              echo " ";
                            }
                            else{

                              foreach ($residuos as $residuo) {
                                echo "<option value=".$residuo["id"].">".$residuo["nome"]."</option>";
                              }
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="group col-md-2 aba2">
                        <span id="spanselect">Resíduo</span>
                        <div class="select-style">
                          <select name="nameresiItem2" >
                            <?php

                            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                            $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE status='Ativo'");
                            $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                            if(count($residuos)==0){
                              echo " ";
                            }
                            else{

                              foreach ($residuos as $residuo) {
                                echo "<option value=".$residuo["id"].">".$residuo["nome"]."</option>";
                              }
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="group col-md-2 aba3">
                        <span id="spanselect">Resíduo</span>
                        <div class="select-style">
                          <select name="nameresiItem3" >
                            <?php

                            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                            $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE status='Ativo'");
                            $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                            if(count($residuos)==0){
                              echo " ";
                            }
                            else{

                              foreach ($residuos as $residuo) {
                                echo "<option value=".$residuo["id"].">".$residuo["nome"]."</option>";
                              }
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                      <!--
                      <div class="group col-md-2 aba4">
                        <span id="spanselect">Resíduo</span>
                        <div class="select-style">
                          <select name="nameresiItem" >
                            <option value="">Selecione...</option>
                            <?php

                            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                            $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE status='Ativo'");
                            $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                            if(count($residuos)==0){
                              echo " ";
                            }
                            else{

                              foreach ($residuos as $residuo) {
                                echo "<option value=".$residuo["nome"].">".$residuo["nome"]."</option>";
                              }
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="group col-md-2 aba5">
                        <span id="spanselect">Resíduo</span>
                        <div class="select-style">
                          <select name="nameresiItem" >
                            <option value="">Selecione...</option>
                            <?php

                            $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
                            $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE status='Ativo'");
                            $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                            if(count($residuos)==0){
                              echo " ";
                            }
                            else{

                              foreach ($residuos as $residuo) {
                                echo "<option value=".$residuo["nome"].">".$residuo["nome"]."</option>";
                              }
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    -->
                    </div>

                    <div class="group col-md-6">
                      <span id="spanselect">Descrição nutricional</span>
                      <br>
                      <textarea cols="40" rows="4" type="text" name="descItem" required></textarea>
                    </div>

                    <input type='hidden' name='statusItem' value="Ativo">

                    <div class="group col-md-6">
                      <span id="spanselect">Selecione a imagem do item:</span>
                      <span class="bar"></span>
                      <input type="file" name="itemImg" accept="image/*" id="itemImg" required>

                      <h5 id="statusImg"></h5>
                    </div>

                    <div class="group col-md-12">
                      <input type='submit' name='botaoItem' id="botaoCad" value='Inserir'>
                    </div>

                  </form>

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

              <script src="js/bootstrap.min.js"></script>

              <script type="text/javascript">
              document.formcadas.nomeItem.focus();
              </script>

            </body>

            </html>
