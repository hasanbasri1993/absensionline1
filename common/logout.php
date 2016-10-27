<?php

  session_start();
  unset($_SESSION["nama"]);
  unset($_SESSION["user"]);
  unset($_SESSION["role"]);
  unset($_SESSION["logged"]);

  echo 'You have cleaned session';
  echo "<script>window.location= 'login.php'</script>";
