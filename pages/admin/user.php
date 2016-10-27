<?php
$rw=mysql_query("
SELECT
	guru.id,
	guru.nid,
	guru.nama_guru,
	guru.username,
	guru.`password`,
	guru.role
FROM
	guru

");
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nilai</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Input Nilai Semester <?php echo $_SESSION['semester']; ?> Tahun Ajaran <?php echo $_SESSION['tahun']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <form role="form" name="pilih" method="post">
                              <div class="col-lg-4">
                              <div class="form-group">

                              </div>
                              </div>
															<span id="errmsg"></span>
															<span id="angka"></span>
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                    	  <tr>
                                    		<th class="table-header" width="10%">No.</th>
                                    		<th class="table-header">Nama Guru</th>
                                    		<th class="table-header">Username</th>
                                        <th class="table-header">Password</th>
                                        <th class="table-header">ROLE</th>
                                        <th class="table-header">ACTION</th>
                                    	  </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $counter = 1;
                                      while($s=mysql_fetch_array($rw))

                                      {

                                      ?>
                                    	  <tr >
                                    		    <td class="center"><?php echo $counter;?></td>
                                    		    <td><?php echo $s['nama_guru']; ?></td>
                                    		    <td><?php echo $s['username']; ?></td>
                                            <td><?php //echo $s['password']; ?> **** </td>
                                            <td><?php echo $s['role']; ?></td>
                                            <td><a href="?cat=admin&page=edituser&id=<?php echo sha1($s['username']); ?>">
                                                <button type="button" class="btn btn-default btn-circle"><i class="fa fa-check"></i>
                                                </a>
                                                <button type="button" class="btn btn-default btn-circle"><i class="fa fa-check"></i>
                                            </td>

                                        </tr>
                                        <?php $counter++; }?>
                                      </tbody>
                                    </table>
