
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
                                            <th>Tahun Ajaran</th>
                                            <th>semester</th>
                                            <th>Status</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    $rw=mysql_query("
                                    SELECT
                                    	*
                                    FROM
                                    	tahun_ajaran                                    ");
                                    while($s=mysql_fetch_array($rw))
                                    {
                                    ?>
                                    <tr>
                                      <td><?php echo $s['tahunajaran']; ?></td>                                      <td><?php echo $s['semster']; ?></td>
                                      <td><?php echo $s['isAktif']; ?></td>
                                      <td> <a class="btn btn-info" href="">
                                              <i class="icon-star"></i> Set Aktif
                                          </a>
                                      </td>
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