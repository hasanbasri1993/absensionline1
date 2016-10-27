            <div class="row">                <div class="col-lg-12">
                    <h1 class="page-header">Daftar Guru</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            -=-
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                    SELECT
                                    	id,
                                    	nid,
                                    	nama_guru
                                    FROM
                                    	guru
                                    ORDER BY nama_guru ASC
                                      ");
                                    while($s=mysql_fetch_array($rw))
                                    {
                                    ?>
                                    <tr>
                                      <td><?php echo $s['id']; ?></td>
                                      <td><?php echo $s['nama_guru']; ?></td>
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
                                  });
                                  </script>
