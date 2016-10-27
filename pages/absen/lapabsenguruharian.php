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
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style media="screen">
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    vertical-align: middle;
		text-align: center;
}
</style>
<div class="container">
        <!-- Page Content goes here -->

<div class="row">
  <div class="col s8">
    <p><b>DATA KONTROL PROSES BELAJAR MENGAJAR ( PBM )</b></p>
    <p><b>SMP DAARUL ULUUM LIDO</b></p>
    <p>TAHUN AJARAN 2016-2017</p>
  </div>
  <div class="col s4">
    <p>Yayasan Salsabila Lido</br>
        Jurior High School </br>
        DAARUL ULUUM LIDO</br>
        JL. Mayjen HR Edi Sukma KM 22 Muara Ciburuy Cigombong Bogor</br>
        Telp. 0251 8224754 www.daarululuumlido</p>
  </div>
</div>
<p>DAY, DATE : <?=date("l, Y - M - d ");?></p>
<table id="laporan" class="stripped">
                                        <thead>
                                          <tr>
      																	    <th rowspan="2">No.</th>
      																	    <th rowspan="2">NAMA GURU</th>
      																	    <th rowspan="2">KELAS / JAM KE-</th>
      																	    <th rowspan="2">MATA PELAJARAN</th>
      																	    <th colspan="2">GURU PENGGANTI</th>
      																	    <th rowspan="2">ABSEN</th>
      																	    <th rowspan="2">KETERANGAN</th>
      																	  </tr>
      																	  <tr>
      																	    <td><b>NAMA</b></td>
      																	    <td><b>MAPEL</b></td>

      																	  </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $rw=mysql_query("
                                          SELECT
                                            tbguruabsen.nama_guru AS guruabsen,
                                            tbgurupengganti.nama_guru AS gurupengganti,
                                            tbpiket.nama_guru AS piket,
                                            jamke,
                                            izin,
                                            keterangan,
                                            nama_pelajaran,
                                            tanggal_input,
                                            tbnamakelas.nama_kelas AS namakelas,
                                            tanggal
                                          FROM
                                            absen_guru
                                          LEFT JOIN guru AS tbguruabsen ON absen_guru.nid_guru = tbguruabsen.nid
                                          LEFT JOIN guru AS tbgurupengganti ON absen_guru.pengganti = tbgurupengganti.nid
                                          LEFT JOIN guru AS tbpiket ON absen_guru.piket_logged = tbpiket.nid
                                          LEFT JOIN kelas AS tbnamakelas ON absen_guru.kelas = tbnamakelas.kode_kelas
                                          LEFT JOIN pelajaran ON kode_pelajaran = matapelajaran

                                          ORDER BY
                                            tanggal ASC
                                          ");
                                          if($rw === FALSE)
                                                 {
                                                   die(mysql_error()); // TODO: better error handling
                                                 }
                                          $counter = 1;
                                          while($s=mysql_fetch_array($rw))
                                          {
                                          ?>

                                            <tr>
                                              <td><?php echo $counter;?></td>
                                              <td><?php echo $s['guruabsen']; ?></td>
                                              <td><?php echo $s['namakelas']." / ".$s['jamke']; ?>
                                              <td></td>
                                              <td><?php echo $s['gurupengganti']; ?></td>
                                              <td><?php echo $s['piket']; ?></td>
                                              <td><?php echo $s['izin'];?></td>
                                            </tr>
                                            <?php
                                            $counter++;

                                            }


                                            ?>

                                        </tbody>

                                  </table>
                                  <div class="row">
                                    <div class="col s8">
                                      <p>Catatan              : </p>
                                      <p>...............................................................</p>
                                      <p>...............................................................</p>
                                    </div>
                                    <div class="col s4">
                                      <p>Cigombong, <?=date("l, d - M - Y");?></p>
                                    </div>
                                  </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
