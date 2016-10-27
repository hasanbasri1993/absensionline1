
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
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <button type="submit">
                                Submit
                              </button>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Alasan</th>
                                            <th>Tanggal</th>
                                            <th>Penginput / Piket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                    SELECT
                                    	siswa.id_siswa,
                                    	siswa.nim,
                                    	siswa.nama_siswa,
                                    	siswa.jeniskelamin,
                                      kelas.nama_kelas
                                    FROM
                                    	siswa
                                    LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
                                    WHERE kelas.nama_kelas = '1A' OR kelas.nama_kelas = '3A'
                                    ORDER BY nama_kelas ASC

    ");
                                    while($s=mysql_fetch_array($rw))
                                    {
                                    ?>
                                    <tr>
                                      <td><?php echo $s['id_siswa']; ?></td>
                                      <td><input  class="form-control" type="text" id="row-1-age" name="<?php echo $s['id_siswa']; ?>" value="<?php echo $s['nim']; ?>"></td>
                                      <td><input  class="form-control" type="text" id="row-1-age" name="<?php echo $s['id_siswa']; ?>" value="<?php echo $s['nama_siswa']; ?>"></td>
                                      <td><input  class="form-control" type="text" id="row-1-age" name="<?php echo $s['id_siswa']; ?>" value="<?php echo $s['jeniskelamin']; ?>"></td>
                                      <td><input  class="form-control" type="text" id="row-1-age" name="<?php echo $s['id_siswa']; ?>" value="<?php echo $s['nama_kelas']; ?>"></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                  </table>
                                  <script>
                                  $(document).ready(function() {
                                     var table = $('#dataTables-example').DataTable({
                                              responsive: true,
                                              scrollY:        500,
                                              scrollCollapse: true,
                                      });
                                      $('button').click( function() {
                                        var data = table.$('input').serialize();
                                        swal("The following data would have been submitted to the server: \n\n"+
                                        data.substr( 0, 50 )+'...');

                                        return false;
                                      } );
                                  });
                                  </script>
