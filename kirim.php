<?  /*
$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

//$user	 = "root";
//$pass	 = "";
//$dabname = "absenkampusdb";
$conn = mysql_connect( $host, $user, $pass) or die("Could not connect to mysql server." );
mysql_select_db($dabname, $conn) or die("Could not select database.");
$rw=mysql_query("
SELECT
kiiriim.RUANG,
kiiriim.`NO URUT UMUM`,
kiiriim.`NO HP`
FROM
kiiriim
");
while($s=mysql_fetch_array($rw))
{
  $isi = "Info%20Daarul%20Uluum%20Lido:%20Ruang%20ujian%20tes%20msk%20di%20GEDUNG%20SMP%20RUANG%20".$s['RUANG'].".%20Waktu%2008.00%20Tes%20Tulis,%2009.00%20Tes%20IQ,%2012.30%20Tes%20Baca%20Tulis%20Qur'an.%0aWAJIB%20hadir%20sblm%20pkl.%2008.00";
  //echo $isi;
  $sms = file_get_contents('https://reguler.zenziva.net/apps/smsapi.php?userkey=56yh2d&passkey=hjve6uly&nohp='.$s['NO HP'].'&pesan='.$isi);
  echo $sms;
  usleep(5000);
}*/


$homepage = file_get_contents('http://webapps.promediautama.com:29003/sms_applications/smsb/api_mt_send_message.php?username=dulido_api&password=6564d84b67f9c21768d8e13fa8724d0c&msisdn=6282213542319&sms=TESTTEST');
echo $homepage;
