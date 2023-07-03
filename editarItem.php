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

    <script  type="text/javascript">

    $(document).ready(function(){
      if( $("#quantidade").val() == 1){
        $(".aba1").show(500);
        $(".aba2").hide(500);
        $(".aba3").hide(500);

      }
      if( $("#quantidade").val() == 2){
        $(".aba1").show(500);
        $(".aba2").show(500);
        $(".aba3").hide(500);

      }
      if( $("#quantidade").val() == 3){
        $(".aba1").show(500);
        $(".aba2").show(500);
        $(".aba3").show(500);

      }
});
      $(function(){
        $("#quantidade").change(function(){


          if( $(this).val() == 1){
            $(".aba1").show(500);
            $(".aba2").hide(500);
            $(".aba3").hide(500);

          }
          if( $(this).val() == 2){
            $(".aba1").show(500);
            $(".aba2").show(500);
            $(".aba3").hide(500);

          }
          if( $(this).val() == 3){
            $(".aba1").show(500);
            $(".aba2").show(500);
            $(".aba3").show(500);

          }


        });
      });

    </script>

    <?php
       $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
       $resultado = mysqli_query($mysqli,"SELECT * FROM itens WHERE ID = " .$_GET['id']);
       $itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

       function selected( $value, $selected ){
         return $value==$selected ? ' selected="selected"' : '';
       }
      ?>


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
           <h1>Editar item</h1>
           <br>
           <form name="formcadas" action='acoesItem.php' method='post' enctype="multipart/form-data">
             <div class="group col-md-6">
               <input type="text" name="nomeItem" maxlength="250" required value=<?php echo "'".$itens[0]['nome']."'"; ?>>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Nome</label>
             </div>
             <div class="group col-md-6">
               <input type="text" name="marcaItem" maxlength="100" required value=<?php echo "'".$itens[0]['marca']."'"; ?>>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Fornecedor</label>
             </div>
             <div class="group col-md-3">
               <span id="spanselect">Unidade de medida</span>
               <div class="select-style">
                 <select name="unidadeItem" >
                   <option value="Mililitros" <?php echo selected( 'Mililitros', $itens[0]['uni_med'] ); ?>>mL</option>
                   <option value="Litros" <?php echo selected( 'Litros', $itens[0]['uni_med'] ); ?>>L</option>
                   <option value="Gramas" <?php echo selected( 'Gramas', $itens[0]['uni_med'] ); ?>>g</option>
                   <option value="Quilos" <?php echo selected( 'Quilos', $itens[0]['uni_med'] ); ?>>Kg</option>
                   <option value="Unidade" <?php echo selected( 'Unidade', $itens[0]['uni_med'] ); ?>>Unidade</option>
                 </select>
               </div>
             </div>
             <div class="group col-md-6">
               <input type="number" name="quantItem" required value=<?php echo "'".$itens[0]['quantidade']."'"; ?>>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Valor da unidade de medida</label>
             </div>
             <div class="group col-md-2">
               <span id="spanselect">Tipo do item</span>
               <div class="select-style">
                 <select class="selectaba" name="tipoItem" >
                   <option value="Comida"<?php echo selected( 'Comida', $itens[0]['tipo'] ); ?>>Comida</option>
                   <option value="Bebida"<?php echo selected( 'Bebida', $itens[0]['tipo'] ); ?>>Bebida</option>
                   <option value="Fruta"<?php echo selected( 'Fruta', $itens[0]['tipo'] ); ?>>Fruta</option>
                 </select>
               </div>
             </div>
             <div class="group col-md-2">
               <span id="spanselect">Quant. de resíduos</span>
               <div class="select-style">
                 <select class="selectaba" id="quantidade" name="resiItem" >
                   <option id="1" value="1"<?php echo selected( '1', $itens[0]['quant_resi'] ); ?>>1</option>
                   <option id="2" value="2"<?php echo selected( '2', $itens[0]['quant_resi'] ); ?>>2</option>
                   <option id="3" value="3"<?php echo selected( '3', $itens[0]['quant_resi'] ); ?>>3</option>
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
               <div class="group col-md-2 aba3" >
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

               </div>


             <div class="group col-md-6">
               <span id="spanselect">Selecione a imagem do item:</span>
               <span class="bar"></span>
               <input type="file" name="itemImg" value=<?php echo $itens[0]['img']; ?> accept="image/*" id="itemImg">
               <span id="statusImg"></span>
             </div>

             <div class="group col-md-6">
               <span id="spanselect">Descrição nutricional</span>
               <br>
               <textarea cols="40" rows="4" type="text" name="descItem" required><?php echo $itens[0]['desc_nutri']; ?></textarea>
             </div>

             <div class="group col-md-2">
               <span id="spanselect" required>Imagem atual:</span>
               <ul class="enlarge">
                 <li><img width='50' height='50' class='imgResi' alt="" src=<?php echo $itens[0]['img']; ?>><span><img class='imgResi' alt="" src=<?php echo $itens[0]['img']; ?>><br /></span></li>
               </ul>
             </div>

             <div class="group col-lg-2">
               <span id="spanselect">Status</span>
               <div class="select-style">
                 <select name="statusItem" value=<?php echo "'".$itens[0]['status']."'"; ?>>
                   <option value="Ativo" <?php echo selected( 'Ativo', $itens[0]['status'] ); ?>>Ativo</option>
                   <option value="Inativo" <?php echo selected( 'Inativo', $itens[0]['status'] ); ?>>Inativo</option>
                 </select>
               </div>
             </div>

             <input type='hidden' name='id' value= <?php echo $itens[0]['id']; ?>>

             <div class="group col-md-12">
               <input type='submit' name='botaoItem' id="botaoCad" value='Alterar'>
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

    <script type="text/javascript">	document.formcadas.nomeItem.focus();</script>

</body>

</html>
