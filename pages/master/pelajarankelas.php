<?phpsetcookie('kelasco', $_POST['kelas'], time() + (9999), "/");$kelascook = $_COOKIE['kelasco'] ;?>            <div class="row">                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Pelajaran Kelas <?=$kelascook;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <div align="center" >
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <a href="?cat=master&page=tambahpelajarankelas" class="btn btn-primary">Tambah Pelajaran Kelas</a>
                                  </div>
                                </div>
                              </div>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kelas</th>
                                            <th>Nama Pelajaran</th>
                                            <th>SKS Pelajaran</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php

                                    $rw=mysql_query("
                                    SELECT
	                                     *
                                    FROM
	                                     mata_pelajaran
                                    LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
                                    LEFT JOIN kelas ON mata_pelajaran.kelas = kelas.kode_kelas
                                    ORDER BY nama_pelajaran ASC


                                    ");
                                    if($cekudahadaapabelum === FALSE)
                                    {
                                      die(mysql_error()); // TODO: better error handling
                                    }
                                    $counter = 1;
                                    while($s=mysql_fetch_array($rw))
                                      {
                                    ?>

                                      <tr>

                                        <td><?php echo $counter;?> </td>
                                        <td><?php echo $s['kelas']; ?></td>
                                        <td>
                                          <input class="form-control" type="hidden" name="namapelajaran" value="<?php echo $s['kode_mata_pelajaran']; ?>" id="namapelajaran" disabled/>
                                          <?php echo $s['nama_pelajaran']; ?>
                                        </td>
                                        <td><?php echo $s['sks_pelajaran']; ?></td>

                                        <td>

                                          <select class="form-control" name="kelas" id="kelasselect" onchange="javascript:location.href = this.value;">
                                            <option>Pilih Kelas</option>
                                            <?php
                                              $q=mysql_query("
                                                  SELECT
	                                                 kelas.kelas_kelas,
	                                                 kelas.kode_kelas,
	                                                 kelas.nama_kelas
                                                  FROM
	                                                  kelas
                                                  WHERE
	                                                 kelas_kelas = '".$s['kelas']."'
                                                  ");
                                                while($r=mysql_fetch_array($q))
                                                  {?>

                                                  <option value="?cat=nilai&page=inputnilai&angkatan=<?php echo $s['kelas']; ?>&kelas=<?php echo $r['kode_kelas']; ?>&pelajaran=<?php echo $s['kode_mata_pelajaran']; ?>"><?php echo $r['nama_kelas']; ?>
                                                  </option>

                                              <?php
                                                }
                                              ?>
                                          </select>

                                        </td>

                                      </tr>

                                    <?php
                                    $counter++;
                                      }
                                    ?>
                                  </table>

                                  <script>
                                  $(document).ready(function() {
                                     //location.href=document.getElementById("kelasselect").value;
                                     var table = $('#dataTables-example').DataTable({
                                              responsive: true
                                      });

                                  });                                  </script>
