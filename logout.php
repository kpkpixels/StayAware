<?php
session_start();
if(isset($_SESSION['tipo'])){
  session_destroy();
	header("location:index.php");
}

?>
