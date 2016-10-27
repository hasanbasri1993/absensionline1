<?php
ob_start();

$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

//$user	 = "root";
//$pass	 = "";
//$dabname = "absenkampusdb";
$conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
mysql_select_db($dabname, $conn) or die('Could not select database.');


//get matched data from skills table
$query = mysql_query("SELECT * FROM guru ORDER BY nid ASC");
while ($r=mysql_fetch_array($query)) {
    $data[] = $r['nid']." | ".$r['nama_guru'];
}
//return json data
//echo strtoupper(json_encode($data));3
echo strtoupper(json_encode($data));
?>
