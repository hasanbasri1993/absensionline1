<?php

require_once("dbcontroller.php");
$semester  = 2 ;
$tahun     = 1 ;
$kelas     = 71 ;
$db_handle = new DBController();

$query_namasiswa = "
SELECT
	siswa.nama_siswa,
	kelas.nama_kelas
FROM
	siswa
LEFT JOIN nilai_santri ON siswa.nim = nilai_santri.nim
LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
WHERE
	kelas.kode_kelas = $kelas
AND nilai_santri.id_semester = $semester
AND nilai_santri.id_tahun_ajaran = $tahun ";

$faq = $db_handle->runQuery($sql);

if (!$faq) {
	die('Invalid query: ' . mysql_error());
}

?>
																	<style>
																	#errmsg
																	{
																		display: none;
																		color: red;
																		position: fixed;
																		top: 50%;
																		left: 50%;
																		/* bring your own prefixes */
																		transform: translate(-50%, -50%);
																	}

																	#angka
																	{
																		color: red;
																	}
																	</style>
																	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                                  <script>
																  function saveToDatabase(editableObj,column,id) {
                                    $(editableObj).css("background","#FFF url(nilai/loaderIcon.gif) no-repeat right");
                                    $.ajax({
                                      url: "nilai/saveedit.php",
                                      type: "POST",
                                      data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                                      success: function(data){
                                        $(editableObj).css("background","#FDFDFD");
                                      }
                                     });
                                  }
                                  </script>

            <div class="row">
                <div class="col-lg-12">
									<?php
									$resultp = mysql_query("SELECT * FROM pelajaran WHERE kode_pelajaran	='$pelajaran'");
									$rowp = mysql_fetch_array($resultp);
									$resultk = mysql_query("SELECT * FROM kelas WHERE 	kode_kelas	='$kelas'");
									$rowk = mysql_fetch_array($resultk);

									?>
                    <h1 class="page-header">Nilai <? echo $rowp['nama_pelajaran']; ?> Kelas  <? echo $rowk['nama_kelas']; ?></h1>
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
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                    	  <tr>
                                    		<th class="table-header" width="10%">No.</th>
                                    		<th class="table-header">Nama Siswa</th>


                                    	  </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach($faq as $k=>$v) {
                                      ?>
                                    	  <tr>
																						<td class="center"><?php echo $k+1; ?> </td>
                                    		    <td><?php echo $faq[$k]["nama_siswa"]; ?></td>
																				</tr>
																				<? } ?>
                                      </tbody>
                                    </table>
