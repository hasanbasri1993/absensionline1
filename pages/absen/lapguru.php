<?php
if($role[0] =='1' OR  $role[0] == '4' OR  $role[0] == '5'){


} else {
  echo "<script>window.location= '../pages/home.php?$nid'</script>";
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Absensi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekap Seluruh Absen Guru


                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Guru</th>
                                            <th>Kelas/Jam-ke</th>
                                            <th>Tanggal Absen</th>
                                            <th>Guru Pengganti</th>
                                            <th>Alasan</th>
                                            <th>Penginput</th>
                                            <th>Tanggal Inpput</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
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
                                     WHERE
                                      absen_guru.isSetuju = 1
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
                                      <td><?php echo $s['tanggal']; ?></td>

                                      <td><?php echo $s['gurupengganti']; ?></td>
                                      <td><?php echo $s['izin']."</br>(".$s['keterangan'].")"; ?></td>
                                      <td><?php echo $s['piket']; ?></td>
                                      <td><?php echo $s['tanggal_input']; ?></td>
                                     </tr>


                                    <?php
                                    $counter++;

                                    }


                                    ?>


                                  </table>

                                  <?
                                  if ($role[0] === '4' OR $role[0] === '1') {
                                    $qblumverifikasi = mysql_query("SELECT count(isSetuju) as jumlahabsenbelumverifikasi from absen_guru WHERE isSetuju ='0'");
                                    $blumverifikasi=mysql_fetch_assoc($qblumverifikasi);

                                  if ($blumverifikasi['jumlahabsenbelumverifikasi'] >= '1' ) {?>
                                    <a class="btn btn-info" href="http://absen.daarululuumlido.com/pages/home.php?cat=absen&page=lapverifikasiabsenguru">
                                      <?="Ada ".$blumverifikasi['jumlahabsenbelumverifikasi']." yang belum diverifikasi";?>
                                    </a>
                                  <?
                                    }}
                                  ?>








                                  <script>


                                  $(document).ready(function() {
                                      $('#dataTables-example').DataTable({
                                              responsive: true,
                                              scrollX: true,
                                      });
                                  });


                                  </script>
