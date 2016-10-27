<?php
mysql_connect("localhost","daarulul_absen","hjve6uly");
mysql_select_db("daarulul_absen");
$kelas = $_GET['kelas'];
$kec = mysql_query("
SELECT
 *
FROM
	kelas
WHERE
	kelas_kelas = $kelas");
echo "<option value=''>-- Pilih Pelajaran --</option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['kode_kelas']."\">".$k['nama_kelas']."</option>\n";
}
?>
