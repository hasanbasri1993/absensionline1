            <div class="row">                <div class="col-lg-12">
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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pelajaran</th>
                                            <th>Nama Pelajaran FULL</th>
                                            <th>SKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                    SELECT
                                      pelajaran.kode_pelajaran,
                                      pelajaran.nama_pelajaran,
                                      pelajaran.nama_pelajaran_full,
                                      pelajaran.sks_pelajaran
                                    FROM
                                      pelajaran
                                    ");
                                    while($s=mysql_fetch_array($rw))
                                      {
                                    ?>
                                    <tr>
                                      <td><?php echo $s['kode_pelajaran']; ?></td>
                                      <td><?php echo $s['nama_pelajaran']; ?></td>
                                      <td><?php echo $s['nama_pelajaran_full']; ?></td>
                                      <td><?php echo $s['sks_pelajaran']; ?></td>
                                    </tr>
                                    <?php
                                      }
                                    ?>
                                  </table>

                                  <script>
                                  $(document).ready(function() {
                                     var table = $('#dataTables-example').DataTable({
                                              responsive: true
                                      });

                                  });                                  </script>
