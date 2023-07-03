<?php
  $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
  $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios");
  $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  $nomeLogin = mysqli_real_escape_string($mysqli, $_POST["nomeLogin"]);
  $senha = mysqli_real_escape_string($mysqli, $_POST["senha"]);

  if(($_POST['nomeLogin']!="") && ($_POST['senha']!="")){

    $verificaAdm = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE status='Ativo' AND funcao='Administrador' AND nome_log = '$nomeLogin' AND senha = '$senha'");
    $admregistro = mysqli_num_rows($verificaAdm);
    $verifica = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE status='Ativo' AND nome_log = '$nomeLogin' AND senha = '$senha'");
    $qregistro = mysqli_num_rows($verifica);

    if (($admregistro)>0){
        session_start();
        $_SESSION['tipo']=1;
        setcookie("nomeLogin",$nomeLogin);
        setcookie("idLogin",$idLogin);
        header("location:index.php");

    }

    elseif (($qregistro)>0){
        session_start();
        $_SESSION['tipo']=2;
        setcookie("nomeLogin",$nomeLogin);
        header("location:index.php");
    }

    elseif ((($admregistro)<=0)||(($qregistro)<=0)){
        //session_start();
        echo "<script type='text/javascript'>
                alert('Usuário inativo ou dados incorretos!');
                window.location='index.php';
            </script>";

        //session_destroy();

          }
    }

?>
