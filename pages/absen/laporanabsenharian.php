<?
$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

//$user	 = "root";
//$pass	 = "";
//$dabname = "absenkampusdb";
$conn = mysql_connect( $host, $user, $pass) or die("Could not connect to mysql server." );
mysql_select_db($dabname, $conn) or die("Could not select database.");


$qkelas=mysql_query("SELECT count(nama_kelas) as nama_kelas from kelas");
$datakelas=mysql_fetch_assoc($qkelas);

$qsiswa=mysql_query("SELECT count(nama_siswa) as jumlahsiswa from siswa");
$datasiswa=mysql_fetch_assoc($qsiswa);

   $now = new \DateTime('now');
   $month = $now->format('m');
   $year = $now->format('Y');

$qsakit=mysql_query("SELECT count(izin) as sakit from absen_siswa
					WHERE DATE(tanggal) = DATE(now()) and izin = 'sakit'");
$datasakit=mysql_fetch_assoc($qsakit);

$qalfa=mysql_query("SELECT count(izin) as alfa from absen_siswa
					WHERE DATE(tanggal) = DATE(now()) and izin = 'alpa'");
$dataalfa=mysql_fetch_assoc($qalfa);

$qizin=mysql_query("SELECT count(izin) as izin from absen_siswa
					WHERE DATE(tanggal) = DATE(now()) and izin = 'izin'");
$dataizin=mysql_fetch_assoc($qizin);


$alpaterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZIN',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
Join kelas kls
On s.namakelas = kls.kode_kelas
ORDER BY
ALPHA DESC
LIMIT 1
");


$sakitterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZIN',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
Join kelas kls
On s.namakelas = kls.kode_kelas
ORDER BY
SAKIT DESC
LIMIT 1
");


$izinterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZIN',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
Join kelas kls
On s.namakelas = kls.kode_kelas
ORDER BY
IZIN DESC
LIMIT 1
");


$sakithariini = $datasakit['sakit'];
$alpahariini = $dataalfa['alfa'];
$izinhariini = $dataizin['izin'];

$isi = "Sakit:%20".$sakithariini."%20Alfa:%20".$alpahariini."%20Izin:%20".$izinhariini;
echo $isi;
//$homepage = file_get_contents('https://reguler.zenziva.net/apps/smsapi.php?userkey=56yh2d&passkey=hjve6uly&nohp=082213542319&pesan=Laporan%20absensi%20hari%20ini%20'.$isi.'%20Laporan%20lengkapnya%20http://bit.ly/lapabha%0aKurikulum');
//echo $homepage;
$nomor = array("082213542319","085219332529","081287504122","082298336563");
foreach ($nomor as $tujuan) {
 file_get_contents('https://reguler.zenziva.net/apps/smsapi.php?userkey=56yh2d&passkey=hjve6uly&nohp='.$tujuan.'&pesan=Laporan%20absensi%20hari%20ini%20'.$isi.'%20Laporan%20lengkapnya%20http://bit.ly/lapabs%0aKurikulum%20SMP%20Daarul%20Uluum%20Lidoa%20Tembusan:Kepsek');
}

?>
