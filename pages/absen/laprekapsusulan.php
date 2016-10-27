            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rekap Susulan</h1>
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
                                            <th>Jam Ke-</th>
                                            <th>Tanggal</th>
                                            <th>Mata Pelajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                   SELECT
                                   *
                                   FROM
    	                              rekap_susulan
                                   LEFT JOIN siswa ON rekap_susulan.id_siswa = siswa.nim
                                   LEFT JOIN pelajaran ON rekap_susulan.pelajaran = pelajaran.kode_pelajaran
                                   ORDER BY nim ASC


                                   ");
                                    $counter = 1;

                                    while($s=mysql_fetch_array($rw))


                                    {


                                    ?>


                                    <tr>


                                      <td><?php echo $counter;?></td>
                                      <td><?php echo strtoupper($s['nama_siswa']); ?></td>
                                      <td><?php echo $s['jam_ke']; ?></td>
                                      <td><?php echo $s['tanggal']; ?></td>
                                      <td><?php echo $s['nama_pelajaran']; ?></td>

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



                                      });


                                  });
                                  function delete_user(uid) {
                                    if (confirm('Yakin mau di PRINT?'))
                                    {
                                      window.location.href = '?cat=tasreh&page=index&urutanabsen=' + uid;
                                    }
                                  }


                                  </script>
