<?
$semester  = $_SESSION['id_semester'];
$tahun     = $_SESSION['id_tahun'];
$kelas     = $_GET['kelas'];;//$_SESSION['pilihkelas'];

$cekangkatan = mysql_query("
  SELECT kelas_kelas
  FROM  kelas
  WHERE kode_kelas =  '".$kelas."'
  ");

  $qsakit=mysql_query("
  SELECT kelas_kelas
  FROM  kelas
  WHERE kode_kelas =  '".$kelas."'
  ");
  $datasakit=mysql_fetch_assoc($qsakit);
  $angkatan = $datasakit['kelas_kelas'];




  $queryjumlah_sks=mysql_query("
    SELECT
      SUM(sks_pelajaran) as jumlahsks, COUNT(nama_pelajaran) as jumlah_pelajaran
    FROM
      mata_pelajaran
    LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
    WHERE
     kelas = '".$datasakit['kelas_kelas']."'
     ORDER by mata_pelajaran.kode_mata_pelajaran ASC
     ");
     while ($rw_jumlahsks = mysql_fetch_array($queryjumlah_sks))
     {
     $jumlahsks = $rw_jumlahsks['jumlahsks'];
     $jumlahpelajaran = $rw_jumlahsks['jumlah_pelajaran'];
    }




    $query__row =mysql_query("
    SELECT
      uas, uts, harian, sks_pelajaran
    FROM nilai_santri
      LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
      LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
    WHERE
      siswa.nim =  '1002'
      AND nilai_santri.id_semester = '".$semester."'
      AND nilai_santri.id_tahun_ajaran = '".$tahun."'
    ");

      while ($rw__row = mysql_fetch_array($query__row))
      {
        $totaluasutsharian  = ROUND(($rw__row['harian'] * (20/100)) + ($rw__row['uts'] * (30/100)) + ($rw__row['uas'] * (50/100)),1);
        echo $totaluasutsharian."|";
      }





    ?>


<style media="screen">
.vertical {
    align-content: center;
    text-align:center;
    height:160px;
    width: 60px;
    font-size: 1vw;
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
}


table {
    text-align:center;
    width:100%;

}

.tg-yw4l {
font-weight: bold;
}

</style>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Absensi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                                  <!-- /.panel-heading -->
                            <div class="dataTable_wrapper">
                            <style type="text/css">
                            .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                            .tg .tg-s6z2{text-align:center}
                            @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                            <div ><table class="tg table-bordered ">
                              <tr>
                                <td class="tg-031e" rowspan="2">NO.</td>
                                <td width="250"  rowspan="2">Nama</td>
                                <?
                                $query_sks=mysql_query("
                                  SELECT
                                    *
                                  FROM
                                    mata_pelajaran
                                  LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
                                  WHERE
                                   kelas = '".$datasakit['kelas_kelas']."'
                                   ORDER by mata_pelajaran.kode_mata_pelajaran ASC
                                   ");


                                   while ($rw_sks = mysql_fetch_array($query_sks))
                                   {
                                   ?>
                                <td class="tg-s6z2"><?=$rw_sks['sks_pelajaran']; ?></td>
                                <? } ?>
                                <td class="tg-031e vertical" rowspan="2">Jumlah Nilai</td>
                                <td class="vertical" rowspan="2">Rata - rata Nilai </td>
                                <td class="tg-031e vertical" rowspan="2">Rangking</td>
                                <td class="tg-031e vertical" rowspan="2">Sakit</td>
                                <td class="tg-031e vertical" rowspan="2">Izin</td>
                                <td class="tg-031e vertical" rowspan="2">Alfa</td>
                                <td class="tg-031e vertical" rowspan="2">Akhlak</td>
                                <td class="tg-031e vertical" rowspan="2">Kebersihan</td>
                                <td class="tg-031e vertical" rowspan="2">Ibadah</td>
                                <td class="tg-031e vertical" rowspan="2">Merah</td>
                                <td class="tg-031e vertical" rowspan="2">Persentase</td>




                              </tr>
                              <tr>
                                <?
                                $query_nama=mysql_query("
                                  SELECT * FROM mata_pelajaran
                                  LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
                                  WHERE kelas = '".$datasakit['kelas_kelas']."'
                                  ORDER by mata_pelajaran.kode_mata_pelajaran ASC
                                  ");

                                   while ($rw_nama = mysql_fetch_array($query_nama))
                                   {
                                   ?>
                                <td class="vertical"> <a href="?cat=nilai&page=inputnilai&angkatan=<?php echo $angkatan; ?>&kelas=<?php echo $kelas; ?>&pelajaran=<?php echo $rw_nama['kode_pelajaran']; ?>"><?=$rw_nama['nama_pelajaran']; ?></a> </td>
                                <? } ?>
                              </tr>
                              <?
                                /*$query_namasiswa=mysql_query("
                              SELECT * FROM siswa
                              LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
                              WHERE  kelas.kode_kelas = '".$kelas."' ORDER by nama_siswa ASC");*/

                              $query_namasiswa =mysql_query("
                              SELECT
                                *
                              FROM
                                siswa
                              LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
                              WHERE
                                namakelas = '".$kelas."'

                              ");


                              if (!$query_namasiswa) {
                              	die('Invalid query: ' . mysql_error());
                              }
                              $counter = 1;
                              while ($rw_namasiswa = mysql_fetch_array($query_namasiswa))
                              {
                              ?>
                              <tr>
                                <td class="tg"><?php echo $counter;?></td>
                                <td class="tg"><?=$rw_namasiswa['nama_siswa']; ?></td>


                               <?
                                $query_namasiswa_row =mysql_query("
                                SELECT
                                  uas, uts, harian, sks_pelajaran
                                FROM nilai_santri
                                  LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
                                  LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
                                WHERE
                                  siswa.nim =  '".$rw_namasiswa['nim']."'
                                  AND nilai_santri.id_semester = '".$semester."'
                                  AND nilai_santri.id_tahun_ajaran = '".$tahun."'
                                ");

                                  while ($rw_row = mysql_fetch_array($query_namasiswa_row))
                                  {
                                    $totaluasutsharian = ROUND(($rw_row['harian'] * (20/100)) + ($rw_row['uts'] * (30/100)) + ($rw_row['uas'] * (50/100)),1);

                                    if ($totaluasutsharian <=3.2 && $totaluasutsharian >=1.1 ) {
                                      $totalbulat = 3;
                                    } elseif  ($totaluasutsharian <=3.7 && $totaluasutsharian >=3.3) {
                                      $totalbulat = 3.5;
                                    } elseif  ($totaluasutsharian <=4.2 && $totaluasutsharian >=3.8) {
                                      $totalbulat = 4;
                                    } elseif  ($totaluasutsharian <=4.7 && $totaluasutsharian >=4.3) {
                                      $totalbulat = 4.5;
                                    } elseif  ($totaluasutsharian <=5.2 && $totaluasutsharian >=4.8) {
                                      $totalbulat = 5;
                                    } elseif  ($totaluasutsharian <=5.7 && $totaluasutsharian >=5.3) {
                                      $totalbulat = 5.5;
                                    } elseif  ($totaluasutsharian <=6.2 && $totaluasutsharian >=5.8) {
                                      $totalbulat = 6;
                                    } elseif  ($totaluasutsharian <=6.7 && $totaluasutsharian >=6.3) {
                                      $totalbulat = 6.5;
                                    } elseif  ($totaluasutsharian <=7.2 && $totaluasutsharian >=6.8) {
                                      $totalbulat = 7;
                                    } elseif  ($totaluasutsharian <=7.7 && $totaluasutsharian >=7.3) {
                                      $totalbulat = 7.5;
                                    } elseif  ($totaluasutsharian <=8.2 && $totaluasutsharian >=7.8) {
                                      $totalbulat = 8;
                                    } elseif  ($totaluasutsharian <=8.7 && $totaluasutsharian >=8.3) {
                                      $totalbulat = 8.5;
                                    } elseif  ($totaluasutsharian <=9.2 && $totaluasutsharian >=8.8) {
                                      $totalbulat = 9;
                                    } elseif  ($totaluasutsharian >=9.3) {
                                      $totalbulat = 9.5;
                                    } else {
                                      $totalbulat = 0;
                                    }


                                    if ($totalbulat < 5) { ?>
                                      <td class="tg-yw4l"><font color="red"><?=$totalbulat;?> </font></td>
                                      <?
                                    } else { ?>
                                      <td class="tg-yw4l"><font color="black"><?=$totalbulat;?> </font></td>
                                      <?   }
                                      }
                                $aaaaa =mysql_query("
                                SELECT
                                  SUM(ROUND(((harian * (20 / 100)) + (uts * (30 / 100)) + (uas * (50 / 100))),1) * sks_pelajaran) as jumlahnilai
                                  FROM nilai_santri
                                  LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
                                  LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
                                WHERE
                                  siswa.nim =  '".$rw_namasiswa['nim']."'
                                  AND nilai_santri.id_semester = '".$semester."'
                                  AND nilai_santri.id_tahun_ajaran = '".$tahun."'
                                ");

                                  while ($bbbbb = mysql_fetch_array($aaaaa))
                                  {
                                    $rata_rata = ROUND(($bbbbb['jumlahnilai'] / $jumlahsks),1);

                                 ?>
                                 <td class="tg-yw4l"><?=$bbbbb['jumlahnilai']; ?> </td>
                                 <td class="tg-yw4l"><?=$rata_rata; ?> </td>
                                 <? }  ?>
                                 <td class="tg-yw4l"><?//=$rw_rangking['rank']; ?></td>
                                 <?
                                 $rw_sakit=mysql_query("
                                 SELECT COUNT(izin)
                                  FROM absen_siswa
                                 WHERE
                                  izin = 'sakit'
                                  AND id_semester = '".$semester."'
                                  AND id_tahun_ajaran = '".$tahun."'
                                  AND nim_siswa='".$rw_namasiswa['nim']."'
                                 ");

                                 if (!$rw_sakit) {
                                   die('Invalid query: ' . mysql_error());
                                       }
                                 while($s=mysql_fetch_array($rw_sakit))
                                 {
                                 ?>
                                 <td><?php echo $s['COUNT(izin)']; ?></td>
                                 <? }

                                 $rw_izin=mysql_query("
                                 SELECT COUNT(izin)
                                  FROM absen_siswa
                                 WHERE
                                  izin = 'izin'
                                  AND id_semester = '".$semester."'
                                  AND id_tahun_ajaran = '".$tahun."'
                                  AND nim_siswa='".$rw_namasiswa['nim']."'
                                 ");

                                 if (!$rw_izin) {
                                   die('Invalid query: ' . mysql_error());
                                       }
                                 while($s=mysql_fetch_array($rw_izin))
                                 {
                                 ?>
                                 <td><?php echo $s['COUNT(izin)']; ?></td>
                                 <? }
                                 $rw_alpa=mysql_query("
                                 SELECT COUNT(izin)
                                  FROM absen_siswa
                                 WHERE
                                  izin = 'alpa'
                                  AND id_semester = '".$semester."'
                                  AND id_tahun_ajaran = '".$tahun."'
                                  AND nim_siswa='".$rw_namasiswa['nim']."'
                                 ");

                                 if (!$rw_alpa) {
                                   die('Invalid query: ' . mysql_error());
                                       }
                                 while($s=mysql_fetch_array($rw_alpa))
                                 {
                                 ?>
                                 <td><?php echo $s['COUNT(izin)']; ?></td>
                                 <? }


                                  ?>
                                  <td><?php echo "sdsf"; ?></td>
                                  <td><?php echo "hgjg"; ?></td>
                                  <td><?php echo "ghjg"; ?></td>

                                  <?
                            $querybawah =mysql_query("
                              SELECT
                                COUNT(IF((harian * (20 / 100) + (uts * (30 / 100)) + (uas * (50 / 100)) * sks_pelajaran) <= '5' ,1, NULL)) as dibawah5

                              FROM nilai_santri
                                LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
                                LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
                              WHERE
                                siswa.nim =  '".$rw_namasiswa['nim']."'
                                AND nilai_santri.id_semester = '".$semester."'
                                AND nilai_santri.id_tahun_ajaran = '".$tahun."'
                                  ");
                                    while ($rw_bwah = mysql_fetch_array($querybawah))
                                      {

                                        $persentasemerah = ($rw_bwah['dibawah5'] / $jumlahpelajaran) * 100 ;
                                      ?>

                                      <td><?php echo $rw_bwah['dibawah5']; ?></td>
                                      <td><?php echo $persentasemerah."%" ;?></td>

                                      <?}?>


                              </tr>
                              <?
                               $counter++;
                              } ?>
                            </table></div>

                                  <script>
                                    $(document).ready(function() {
                                      $('#dataTahjbles-example').DataTable({
                                              responsive: true,
                                              bPaginate: false,
                                              bSort : false
                                      });

                                  });
                                  </script>
