<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = mysql_query("UPDATE nilai_santri set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id_nilai=".$_POST["id"]);
?>
