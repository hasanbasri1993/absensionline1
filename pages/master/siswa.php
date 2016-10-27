

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Master Data</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Table Data Siswa

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">
                          <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Launch demo modal</a>

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>No.</th>

                                            <th>Nama Siswa</th>

                                            <th>Jenis Kelamin</th>

                                            <th>Kelas</th>

                                            <th>Aktif</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tr>

                                    <?php

                                    $rw=mysql_query("

                                    SELECT
                                      siswa.id_siswa,
                                      siswa.photo,
                                    	siswa.nim,
                                    	siswa.nama_siswa,
                                    	kelas.nama_kelas,
                                      siswa.jeniskelamin
                                    FROM
                                    	siswa
                                    LEFT JOIN kelas_santri ON id_santri = siswa.nim
                                    LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas


                                    ");
                                    $cekidterakhir=mysql_query("

                                    SELECT
                                    	nim
                                    FROM
                                    	siswa
                                    ORDER BY nim DESC
                                    LIMIT 1
                                    ");
                                    $idterakhir=mysql_fetch_assoc($cekidterakhir);
                                    $terakhir = $idterakhir['nim'];
                                    $idsiswabaru =  $terakhir + 1;
                                    echo $idsiswabaru;
                                    $counter = 1;
                                    while($s=mysql_fetch_array($rw))

                                    {

                                    ?>

                                    <tr>

                                      <td><?php echo $counter;?></td>

                                      <td><?php echo $s['nama_siswa']; ?></td>

                                      <td><?php echo $s['jeniskelamin']; ?></td>

                                      <td><?php echo $s['nama_kelas']; ?></td>

                                      <td>

                                        <?php if ($s['photo'] == NULL) { ?>

                                          <a target="_self" class="btn btn-info" href="http://absen.daarululuumlido.com/pages/master/uploadfoto/index.php?id_siswa=<?php echo $s['id_siswa']; ?>">
                                            <i>Upload FOTO</i>
                                          </a>

                                        <?php
                                          } else {
                                          ?>
                                          <a target="_self" class="btn btn-info" href="http://absen.daarululuumlido.com/pages/master/uploadfoto/index.php?id_siswa=<?php echo $s['id_siswa']; ?>">
                                            <img src="http://absen.daarululuumlido.com/pages/master/uploadfoto/uploads/150_<?php echo $s['photo']; ?>" alt="<?php echo $s['nama_siswa']; ?>" />
                                          </a>
                                        <?php
                                        }
                                        ?>


                                        </td>


                                    </tr>

                                    <?php
									$counter++;

                                    }

                                    ?>



                                  </table>
                                  <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Launch demo modal</a>

                                  <!-- Modal -->
                                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                          <h4 class="modal-title">Tambah Siswa</h4>
                                        </div>
                                        <div class="modal-body">
                                          <form method="post" role="form" name="form">
                                            <div class="form-group">
                                              <label>NIM </label>
                                              <input type="text" disable name="nim" value="<?echo $idsiswabaru;?>" id="nim" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                              <label>Nama Siswa </label>
                                              <input type="text" name="nama_siswa" value="" id="nama_siswa" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                              <label>Role</label>
                                              <select class="form-control" name="role">
                                                <option value="p">P</option>
                                                <option value="l">L</option>
                                              </select>

                                            </div>
                                            <button type="tambahsiswa" name="simpan" class="btn btn-default">Submit Button</button>
                                            <button type="reset" class="btn btn-default">Reset Button</button>
                                          </form>
                                		    </div>
                                        <div class="modal-footer">

                                        </div>
                                      </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                  </div><!-- /.modal -->
                                  <script>

                                  $(document).ready(function() {
                                     var table = $('#dataTables-example').DataTable({
                                              responsive: true,
                                              scrollY:        500,
                                              scrollCollapse: true
                                      });

                                  });

                                  </script>

<?php

  if(isset($_POST['tambahsiswa']))
  {
	$q1=mysql_query("Insert into siswa (`nim`,`nama_siswa`,`jeniskelamin`) values
                 ('".$_POST['nim']."','".$_POST['nama_siswa']."','".$_POST['jeniskelamin']."')");

         if($q1 === FALSE)
                {
                  die(mysql_error()); // TODO: better error handling
                }
          if($q1)
        		{
       			echo"<script>swal({ title: 'Daarul Uluum Lido',
        								text: 'Password berhasil dirubah!',
        								timer: 2000,
        								type:'success',
        								showConfirmButton: false });

       								window.location='?cat=admin&page=user'
        				 </script>";


        	  }else{
        		echo "<script>swal({ title: 'Daarul Uluum Lido',
        								text: 'Password gagal dirubah!',
        								timer: 2000,
        								type:'error',
        								showConfirmButton: false });
        				 </script>";
               }
}
?>
