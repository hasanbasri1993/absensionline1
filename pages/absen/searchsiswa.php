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
$query = mysql_query("SELECT
                        siswa.nim,
                        siswa.nama_siswa,
                        kelas.nama_kelas,
                        siswa.jeniskelamin
                      FROM
                        siswa
                      LEFT JOIN kelas_santri ON id_santri = siswa.nim
                      LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                      ");
while ($r=mysql_fetch_array($query)) {
    $data[] = $r['nim']." | ".$r['nama_siswa']." | ".$r['nama_kelas'];

}
//return json data
//echo strtoupper(json_encode($data));3
echo strtoupper(json_encode($data));

/*$query = mysql_query("SELECT
                        siswa.nim,
                        siswa.nama_siswa,
                        kelas.nama_kelas,
                        siswa.jeniskelamin
                      FROM
                        siswa
                      LEFT JOIN kelas_santri ON id_santri = siswa.nim
                      LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                      ");

while ($r=mysql_fetch_array($query)) {

  $results[] = array(
		"NIM" =>        $r['nim'],
		"NAMASISWA" =>  $r['nama_siswa'],
		"KELAS" =>      $r['nama_kelas']
	);
}

echo json_encode($results);*/
?>
