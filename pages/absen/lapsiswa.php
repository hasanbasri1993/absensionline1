<?php
if($role[0] =='1' OR  $role[0] == '4' OR  $role[0] == '5'){


} else {
  echo "<script>window.location= '../pages/home.php?$nid'</script>";
}
?>           <div class="row">
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
                            Rekap Seluruh Absen Siswa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Alasan</th>
                                            <th>Tanggal</th>
                                            <th>Penginput / Piket</th>
                                            <th>Tanggal Input</th>
                                            <th>Jam Input</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                      SELECT
                                      *
                                        FROM
                                      absen_siswa
                                      LEFT JOIN siswa ON absen_siswa.nim_siswa = siswa.nim
                                      LEFT JOIN guru ON absen_siswa.logged = guru.nid
                                      ORDER BY tanggal ASC
                                      ");
                                    $counter = 1;

                                    while($s=mysql_fetch_array($rw))


                                    {


                                    ?>


                                    <tr>


                                      <td><?php echo $counter;?></td>
                                      <td><?php echo $s['nama_siswa']; ?></td>

                                      <td><?php echo $s['izin']; ?></td>

                                      <td><?php echo $s['tanggal']; ?></td>

                                      <td><?php echo $s['nama_guru']; ?></td>

                                      <td><?php echo $s['tanggal_input']; ?></td>
                                      <td><?php echo $s['jam_input']; ?></td>

                                      <td class="text-center"><a href="javascript: printtasreh(<?php echo $s['id_data']; ?>)"> Print </a></td>








                                    </tr>


                                    <?php
                                    $counter++;

                                    }


                                    ?>


                                  </table>


                                  <script>


                                  $(document).ready(function() {


                                      $('#dataTables-example').DataTable({
                                              responsive: true,
                                              scrollX: true,
                                        });


                                  });
                                  function printtasreh(uid) {
                                    if (confirm('Yakin mau di PRINT?'))
                                    {
                                      window.location.href = '?cat=tasreh&page=index&urutanabsen=' + uid;
                                    }
                                  }


                                  </script>
