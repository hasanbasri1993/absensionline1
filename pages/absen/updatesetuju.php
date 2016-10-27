<?
$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

$conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
mysql_select_db($dabname, $conn) or die('Could not select database.');

if($_GET['id'])
{
$id=$_GET['id'];
$sql = "UPDATE absen_guru SET isSetuju = '1'WHERE id_data='$id'";
mysql_query( $sql);

if ($sql) {
  echo "<script>window.location= 'http://absen.daarululuumlido.com/pages/home.php?cat=absen&page=lapverifikasiabsenguru'</script>";
  # code...
}
}
?>
