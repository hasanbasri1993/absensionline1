<?php
$daritanggal = $_POST['daritanggal'];
$sampaitanggal = $_POST['sampaitanggal'];
 ?>

<style media="screen">
.table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    vertical-align: middle;
		text-align: center;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

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
                              <form role="form" name="pilih" method="post">
                                <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <input id="daritanggal" placeholder="Dari tanggal"name="daritanggal" class="form-control datepicker" type="text">

                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <input id="sampaitanggal" placeholder="Sampai tanggal"name="sampaitanggal" class="form-control datepicker" type="text">
                                  </div>
                                </div>
                              </div>
                                <div class="form-group">
                                  <button  name="tampilkan" type="submit" class="form-control btn btn-primary">Submit</button>
                                </div>
                              </form>
                              <div class="table-responsive">

                                <table width="100%" class="table table-bordered table-hover table-condensed" id="dataTables-example" >
                                  <thead>
																	  <tr>
																	    <th>No.</th>
																	    <th>NAMA GURU</th>
                                      <th>SAKIT</th>
																	    <th>IZIN DINAS</th>
																	    <th>IZIN PULANG</th>
																	    <th>ALFA</th>
																			<th>MENGGANTIKAN</th>
																	  </tr>
                                  </thead>
																		<?php
																		$rw=mysql_query("
																		SELECT
																			g.nama_guru 'NAMA GURU',
																			IFNULL((SELECT COUNT(*) FROM absen_guru a WHERE a.izin = 'sakit' 			 AND a.nid_guru=g.nid AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nid_guru),0) 'SAKIT',
																			IFNULL((SELECT COUNT(*) FROM absen_guru a WHERE a.izin = 'alpa' 			 AND a.nid_guru=g.nid AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nid_guru),0) 'ALPA',
																			IFNULL((SELECT COUNT(*) FROM absen_guru a WHERE a.izin = 'izin dinas'	 AND a.nid_guru=g.nid AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nid_guru),0) 'IZIN DINAS',
																			IFNULL((SELECT COUNT(*) FROM absen_guru a WHERE a.izin = 'izin pulang' AND a.nid_guru=g.nid AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nid_guru),0) 'IZIN PULANG',
																			IFNULL((SELECT COUNT(*) FROM absen_guru a WHERE a.pengganti=g.nid GROUP BY a.pengganti),0) 'GANTI'
																		FROM
																			guru g

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
																			<td align="center"><?php echo $counter;?></td>
																			<td><?php echo $s['NAMA GURU']; ?></td>
																			<td align="center"><?php echo $s['SAKIT']; ?></td>
																			<td align="center"><?php echo $s['ALPA']; ?></td>
																			<td align="center"><?php echo $s['IZIN DINAS']; ?></td>
																			<td align="center"><?php echo $s['IZIN PULANG']; ?></td>
																			<td align="center"><?php echo $s['GANTI']; ?></td>
																		</tr>
																		<?php
																		$counter++;
																		}
																		?>

																	</table>
                                </div>

                                <script>
                                  $(document).ready(function() {
                                    $('#dataTables-example').DataTable({
                                      dom: 'Bfrtip',
                                      scrollX: true,
                                      buttons: [
                                          {
                                              extend: 'excelHtml5',
                                              text: 'Export Ke Excel',
                                              customize: function( xlsx ) {
                                                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                  $('row:first c', sheet).attr( 's', '42' );
                                              }
                                          }
                                      ]
                                    });

                                      $('#daritanggal').pickadate(
                                        {

                                          format: 'yyyy-mm-dd'

                                        }
                                      )

                                      $('#sampaitanggal').pickadate(
                                        {

                                          format: 'yyyy-mm-dd'

                                        }
                                      )
                                  });
                                  </script>
