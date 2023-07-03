<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="theme-color" content="#004d40">

  <title>Fique Esperto</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
  <link rel="icon" href="img//icone_verde.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img//icone_verde.ico" type="image/x-icon" />
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/half-slider.css" rel="stylesheet">
  <link href="css/build.css" rel="stylesheet">


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>

        </button>
        <a id="brand" class="navbar-brand" href="index.php">Fique Esperto</a>
      </div>


    </ul>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php
        $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
        $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios");
        $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        include_once "Usuario.class.php";

        session_start();
        if(!isset($_SESSION['tipo'])){
          echo '<li class="dropdown"><a  id="linkbarra" class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="material-icons left" style="font-size:12px">input</i> Olá Visitante <span class="caret"></span></a>
          <ul class="dropdown-menu">

          <form class="" action="login.php" method="post">
          <label1 for="usr">Username:</label1>
          <input type="text" class="form-control"  name="nomeLogin" id="usr" required>
          <label1 for="pwd">Senha:</label1>
          <input type="password" class="form-control" name="senha" id="pwd" required>
          <a class="recuperar" href="formSenha.php">Recuperar senha</a>
          <br>
          <br>
          <input class="botaoCad" type="submit" id="botaoCad" value="Entrar">
          </form>

          </ul>
          </li>';
        }
        elseif ($_SESSION['tipo']==1) {
          $login_cookie = $_COOKIE['nomeLogin'];
          $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
          $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios where nome_log='$login_cookie'  ");
          $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
          foreach ($usuarios as $usuario) {
            $id = $usuario["ID"];
            $nome = $usuario["nome"];
          }

          if(isset($login_cookie)){
            echo '<li class="dropdown"><a id="linkbarra" class="dropdown-toggle" data-toggle="dropdown" href="#"><i style="font-size:12px"></i> Olá '.$nome.' <span class="caret"></span></a>
            <ul class="dropdown-menu perfil">

            <li><a id="linkop" href="perfil.php?id='.$id.'">Perfil</a></li>
            <li class="divider"></li>
            <li><a id="linkop" href="logout.php">Logout</a></li>

            </ul>
            </li>';
          }
        }
        elseif ($_SESSION['tipo']==2) {
          $login_cookie = $_COOKIE['nomeLogin'];
          $mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
          $resultado = mysqli_query($mysqli,"SELECT * FROM usuarios where nome_log='$login_cookie'  ");
          $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
          foreach ($usuarios as $usuario) {
            $id = $usuario["ID"];
            $nome = $usuario["nome"];
          }
          if(isset($login_cookie)){
            echo '<li class="dropdown"><a id="linkbarra" class="dropdown-toggle" data-toggle="dropdown" href="#"><i style="font-size:12px"></i> Olá '.$nome.' <span class="caret"></span></a>
            <ul class="dropdown-menu perfil">

            <li><a id="linkop" href="perfil.php?id='.$id.'">Perfil</a></li>
            <li class="divider"></li>
            <li><a id="linkop" href="logout.php">Logout</a></li>

            </ul>
            </li>';
          }
        }
        ?>

      </ul>
