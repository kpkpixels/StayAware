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
      echo '<a id="linkbarra"  class="acessado" href="admGerencia.php">Gerenciamento</a>';
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
       $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
       $resultado = mysqli_query($mysqli,"SELECT * FROM residuos WHERE id = " .$_GET['id']);
       $residuos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

       $nome_residuo = $residuos[0]["nome"];

       function selected( $value, $selected ){
         return $value==$selected ? ' selected="selected"' : '';
       }
      ?>

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
      $("#nomeResi").change(function(){
        var residuo = "<?php echo "$nome_residuo" ?>";
        if (residuo != $("#nomeResi").val()){
                  jQuery.ajax({
                  url: "verificarResiduo.php",
                  data:'residuo='+$(nomeResi).val(),
                  type: "POST",
                  success:function(data){
              if(data == true){
                $("#statusResi").html("<font color='red'>Resíduo já cadastrado!</font>");
                $("#botaoCad").attr("disabled", true);
              }else{
                $("#statusResi").html("Resíduo disponível.");
                $("#botaoCad").attr("disabled", false);
              }
                  },
                  error:function (){}
                  });
              }else{
                $("#statusResi").html("Resíduo disponível.");
                $("#botaoCad").attr("disabled", false);
              }
            });
    });
    </script>

        <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-12">
            <h4>Usuário</h4>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="cadastrarUser.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarUser.php"> Listar</button>
            <br>
            <br>
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
            <button id="botao" type="submit" formaction="cadastrarCardapio.php"> Cadastrar</button>

            <form action="cadastrarUser" method="post">
            <button id="botao" type="submit" formaction="listarCardapio.php"> Listar</button>

          </form>
        </div>





        <div class="col-md-10 col-sm-10 col-xs-12" >
          <h1>Editar resíduo</h1>
          <br>
          <form name="formcadas" action='acoesResiduo.php' method='post' enctype="multipart/form-data">
              <div class="group col-md-12">
                <input type="text" name="nomeResi" id="nomeResi" required value=<?php echo "'".$residuos[0]['nome']."'"; ?>>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Nome do resíduo</label>
                <h5 id='statusResi'></h5>
              </div>
                <div class="group col-md-2">
                <span id="spanselect">Tipo do resíduo</span>
                <div class="select-style">
                  <select class="selectaba" name="tipoResi" >
                    <option id="1" value="Papel" <?php echo selected( 'Papel', $residuos[0]['tipo'] ); ?>>Papel</option>
                    <option id="2" value="Plástico"<?php echo selected( 'Plástico', $residuos[0]['tipo'] ); ?>>Plástico</option>
                    <option id="3" value="Orgânico"<?php echo selected( 'Orgânico', $residuos[0]['tipo'] ); ?>>Orgânico</option>
                    <option id="4" value="Rejeito"<?php echo selected( 'Rejeito', $residuos[0]['tipo'] ); ?>>Rejeito</option>
                    <option id="5" value="Metal"<?php echo selected( 'Metal', $residuos[0]['tipo'] ); ?>>Metal</option>
                    <option id="6" value="Vidro"<?php echo selected( 'Vidro', $residuos[0]['tipo'] ); ?>>Vidro</option>
                  </select>
                </div>
              </div>
              <div class="group col-md-2">
                <span id="spanselect">Status</span>
                <div class="select-style">
                  <select name="statusResi" value=<?php echo "'".$residuos[0]['status']."'"; ?>>
                    <option value="Ativo" <?php echo selected( 'Ativo', $residuos[0]['status'] ); ?>>Ativo</option>
                    <option value="Inativo" <?php echo selected( 'Inativo', $residuos[0]['status'] ); ?>>Inativo</option>
                  </select>
                </div>
              </div>

              <div class="group col-md-12">
                <span id="spanselect" required>Selecione a imagem do resíduo:</span>

                <input type="file" name="resiImg" accept="image/*" onblur="verificarImg()" id="itemImg">
                <span id="statusImg"></span>
              </div>

              <div class="group col-md-6">
                <span id="spanselect" required>Imagem atual:</span>
                <ul class="enlarge">
                  <li><img width='50' height='50' class='imgResi' alt="" src=<?php echo "'".$residuos[0]['img']."'"; ?>><span><img class='imgResi' alt="" src=<?php echo "'".$residuos[0]['img']."'"; ?>><br /></span></li>
                </ul>
              </div>

              <input type='hidden' name='id' value= <?php echo $residuos[0]['id']; ?>>

            <div class="group col-md-12">
              <input type='submit' name='botaoResiduo' id="botaoCad" value='Alterar'>
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

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js">

      $("#campoTelefone").unmask("+99(99)9999-9999");
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">	document.formcadas.nomeResi.focus();</script>

</body>

</html>
