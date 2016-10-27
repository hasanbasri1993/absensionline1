<?php
session_start();

if(!isset($_SESSION['role']))
{
	echo "<script>window.location='common/login.php'</script>";
}else {
  echo "<script>window.location='pages/home.php'</script>";
}
