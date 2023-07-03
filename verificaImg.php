<?php

if(isset($_POST['itemImg'])){

$valido=false;
$ehImg=false;

$extensoes= array("jpg","png","jpeg","JPG","PNG","JPEG");
$nome = $_POST['itemImg'];
$infos=explode(".", $nome);
$extensao=end($infos);

foreach ($extensoes as $valor) {
  if($valor==$extensao){
    $valido=true;
    //echo"tsetets";
  }
}

    if($valido){
      echo true;
    }
    else{
      echo false;
    }

}

?>
