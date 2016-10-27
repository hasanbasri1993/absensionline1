<?phpinclude "../../common/phpexcel/PHPExcel.php";

$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

//$database = mysql_connect( $host, $user, $pass) or die("Could not connect to mysql server." );
//            mysql_select_db($dabname, $database) or die("Could not select database.");

$database = new mysqli("localhost", "daarulul_absen", "hjve6uly", "daarulul_absen") or die("Could not connect to mysql server." );

date_default_timezone_set("Asia/Jakarta");$excelku = new PHPExcel();

// Set properties
$excelku->getProperties()->setCreator("Hasan Basri")
                         ->setLastModifiedBy("Hasan Basri");

// Set lebar kolom$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(12);


// Mergecell, menyatukan beberapa kolom$excelku->getActiveSheet()->mergeCells('A1:F1');
$excelku->getActiveSheet()->mergeCells('A2:F2');

// Buat Kolom judul tabel$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'Data Barang'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'Nama'); //Kolom Nama
$SI->setCellValue('C3', 'Kelas'); //Kolom jenis
$SI->setCellValue('D3', 'Sakit'); //Kolom suplier
$SI->setCellValue('E3', 'Izin'); //Kolom suplier
$SI->setCellValue('F3', 'Alpa'); //Kolom suplier

//Mengeset Syle nya$headerStylenya = new PHPExcel_Style();
$bodyStylenya   = new PHPExcel_Style();

$headerStylenya->applyFromArray(	array('fill' 	=> array(
		  'type'    => PHPExcel_Style_Fill::FILL_SOLID,
		  'color'   => array('argb' => 'FFEEEEEE')),
		  'borders' => array('bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
						'left'	  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		  )
	));

$bodyStylenya->applyFromArray(	array('fill' 	=> array(
		  'type'	  => PHPExcel_Style_Fill::FILL_SOLID,
		  'color' 	=> array('argb' => 'FFFFFFFF')),
		  'borders' => array(
						'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
						'left'	  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		  )
    ));

//Menggunakan HeaderStylenya$daritanggal     = $_COOKIE['daritanggal'];
$sampaitanggal   = $_COOKIE['sampaitanggal'];
$kelas           = $_COOKIE['kelas'];
$rombel          = $_COOKIE['rombel'];
$excelku->getActiveSheet()->setSharedStyle($headerStylenya, "A3:F3");

// Mengambil data dari tabelif (!empty($kelas) and $rombel == NULL ) {
  $rw=mysql_query("
  SELECT
    s.nama_siswa 'NAMA SISWA',
    s.jeniskelamin 'L/P',kls.nama_kelas,
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZIN',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
  FROM siswa s
    Join kelas kls
    On s.namakelas = kls.kode_kelas
  WHERE kelas_kelas = $kelas
  ORDER BY
    kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
  ");

} elseif (!empty($kelas) and !empty($rombel) ) {  $rw=mysql_query("
  SELECT
    s.nama_siswa 'NAMA SISWA',
    s.jeniskelamin 'L/P',kls.nama_kelas,
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZIN',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
  FROM siswa s
    Join kelas kls
    On s.namakelas = kls.kode_kelas
  WHERE
    kelas_kelas = $kelas AND kode_kelas = $rombel
  ORDER BY
    kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
  ");
} else {
  $rw=mysql_query("
  SELECT
    s.nama_siswa 'NAMA SISWA',
    s.jeniskelamin 'L/P',kls.nama_kelas,
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZIN',
    IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
  FROM
    siswa s
    Join kelas kls
    On s.namakelas = kls.kode_kelas
  ORDER BY
    kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
  ");

}$res    = $database->query($rw);
if (!$res) {
      die('Invalid query: ' . mysql_error());
}

$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel$no     = 1;

while ($row = $res->fetch_assoc()) {  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['NAMA SISWA']); //mengisi data untuk nama
  $SI->setCellValue("C".$baris,$row['nama_kelas']); //mengisi data untuk jenis
  $SI->setCellValue("D".$baris,$row['SAKIT']); //mengisi data untuk suplier
  $SI->setCellValue("E".$baris,$row['IZIN']); //mengisi data untuk suplier
  $SI->setCellValue("F".$baris,$row['ALPA']); //mengisi data untuk suplier
  $baris++; //looping untuk barisnya
}

//Membuat garis di body tabel (isi data)$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, "A4:F$baris");

//Memberi nama sheet$excelku->getActiveSheet()->setTitle('Barang');
$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsxheader('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=rekakabsen.xlsx');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
