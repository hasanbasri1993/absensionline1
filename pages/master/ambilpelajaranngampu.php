<?php
mysql_connect("localhost","daarulul_absen","hjve6uly");
mysql_select_db("daarulul_absen");
$kelas = $_GET['kelas'];

$kec = mysql_query("
SELECT
	mata_pelajaran.kelas,
	pelajaran.nama_pelajaran
FROM
	mata_pelajaran
LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
WHERE
	kelas = $kelas");

echo "<option>-- Pilih  gf Pelajaran --</option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['kode_mata_pelajaran']."\">".$k['nama_pelajaran']."</option>\n";
		?>


<?}?>
