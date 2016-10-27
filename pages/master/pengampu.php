            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables h fghgf h
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <div class="">

                              </div>
                              <div align="center" >
                                <a href="?cat=master&page=tambahpengampu" class="btn btn-primary">Tambah</a>
                              </div>
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>Nama Guru</th>
                                          <th>Kelas</th>
                                          <th>Mata Pelajaran</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tr>
                                  <?php
                                  $rw=mysql_query("
                                  SELECT
                                  	pelajaran.nama_pelajaran,
                                  	pelajaran.sks_pelajaran,
                                  	pejaran_pengampu.id_semester,
                                  	pejaran_pengampu.id_tahun_ajaran,
                                  	kelas.nama_kelas,
                                  	guru.nama_guru
                                  FROM
                                  	pejaran_pengampu
                                  LEFT JOIN pelajaran ON pejaran_pengampu.kode_mata_pelajaran = pelajaran.kode_mata_pelajaran
                                  LEFT JOIN kelas ON pejaran_pengampu.kode_kelas = kelas.kode_kelas
                                  LEFT JOIN guru ON pejaran_pengampu.nid = guru.nid
                                  ");
                                    $counter = 1;
                                  while($s=mysql_fetch_array($rw))
                                  {
                                  ?>
                                  <tr>
                                    <td><?php echo $counter;?></td>
                                    <td><?php echo $s['nama_guru']; ?></td>
                                    <td><?php echo $s['nama_kelas']; ?></td>
                                    <td><?php echo $s['nama_pelajaran']; ?></td>
                                  </tr>

<?php $counter++; } ?>
                                </table>
                                <script>

                                $(document).ready(function() {

                                    $('#dataTables-example').DataTable({

                                            responsive: true

                                    });

                                });


                                </script>
