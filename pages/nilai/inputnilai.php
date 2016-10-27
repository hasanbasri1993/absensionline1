<?php

require_once("dbcontroller.php");
$semester  = $_SESSION['id_semester'];
$tahun     = $_SESSION['id_tahun'];
$pelajaran = $_GET['pelajaran']; //$_SESSION['pilihpelajaran'];
$kelas     = $_GET['kelas'];;//$_SESSION['pilihkelas'];


$cekangkatan = mysql_query("
  SELECT kelas_kelas
  FROM  kelas
  WHERE kode_kelas =  '".$kelas."'
  ");

  $qsakit=mysql_query("
  SELECT kelas_kelas
  FROM  kelas
  WHERE kode_kelas =  '".$kelas."'
  ");
  $datasakit=mysql_fetch_assoc($qsakit);
  $angkatan = $datasakit['kelas_kelas'];

$db_handle = new DBController();

if (is_null($pelajaran) && is_null($kelas)) {
	$angkatan = 1;
	$sql = "
	SELECT
		nilai_santri.id_nilai,
		siswa.nama_siswa,
		kelas.nama_kelas,
		pelajaran.nama_pelajaran,
		nilai_santri.harian,
		nilai_santri.uts,
		nilai_santri.uas,
		nilai_santri.id_semester,
		nilai_santri.id_tahun_ajaran
	FROM
		nilai_santri
	LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
	LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
	LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
	WHERE
  kelas.kode_kelas ='71'
	AND nilai_santri.pelajaran = '1'
  AND nilai_santri.id_semester = $semester
	AND nilai_santri.id_tahun_ajaran = $tahun";
} else {
	$sql = "
	SELECT
		nilai_santri.id_nilai,
		siswa.nama_siswa,
		kelas.nama_kelas,
		pelajaran.nama_pelajaran,
		nilai_santri.harian,
		nilai_santri.uts,
		nilai_santri.uas,
		nilai_santri.id_semester,
		nilai_santri.id_tahun_ajaran
	FROM
		nilai_santri
	LEFT JOIN siswa ON nilai_santri.nim = siswa.nim
	LEFT JOIN pelajaran ON nilai_santri.pelajaran = pelajaran.kode_pelajaran
	LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
	WHERE
		kelas.kode_kelas = $kelas
	AND nilai_santri.pelajaran = $pelajaran
	AND nilai_santri.id_semester = $semester
	AND nilai_santri.id_tahun_ajaran = $tahun";
}



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
                            Input Nilai Semester <?php echo $semester; ?> Tahun Ajaran <?php echo $tahun; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <form role="form" name="pilih" method="post">
                              <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Pilih Pelajaran</label>
                                <select class="form-control" name="kelas" id="kelasselect" onchange="javascript:location.href = this.value;">
																	<option>Pilih Pelajaran</option>
																	<?php
                                  $q=mysql_query("
																	SELECT
																		*
																	FROM
																		mata_pelajaran
																	LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
																	WHERE
 																		mata_pelajaran.kelas = $angkatan
																	ORDER by mata_pelajaran.kode_mata_pelajaran ASC
																	");
                                  while($r=mysql_fetch_array($q))
                                  {
                                  ?>
																	<option value="?cat=nilai&page=inputnilai&angkatan=<?php echo $angkatan; ?>&kelas=<?php echo $kelas; ?>&pelajaran=<?php echo $r['kode_pelajaran']; ?>"><?php echo $r['nama_pelajaran']; ?></option>
                                  <?php
                                  }
                                  ?>
                                  </select>
                              </div>
                              </div>
                              <div class="col-lg-4">
                              <div class="form-group">
                                  <label>Pilih Kelas</label>
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
																	 kelas_kelas = '".$angkatan."'");
                                  while($r=mysql_fetch_array($q))
                                  {
                                  ?>

                                  <option value="?cat=nilai&page=inputnilai&angkatan=<?php echo $angkatan; ?>&kelas=<?php echo $r['kode_kelas']; ?>&pelajaran=<?php echo $angkatan; ?>"><?php echo $r['nama_kelas']; ?></option>

                                  <?php
                                  }
                                  ?>
                                  </select>
                              </div>
                              </div>
															<div class="col-lg-4">
                              <div class="form-group">
																<div id="errmsg" class="alert alert-danger">

                                </div>
															 <span ></span>
															</div>
															</div>



                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                    	  <tr>
                                    		<th class="table-header" width="10%">No.</th>
                                    		<th class="table-header">Nama Siswa</th>
																				<?
																				if ($_GET[pelajaran]==1 or $_GET[pelajaran]==2 or $_GET[pelajaran]==3 ){
																		    ?>
																				<th class="table-header">NILAI</th>
																			<?php
																		}
																			else
																			  { ?>
																				<th class="table-header">HARIAN</th>
																				<th class="table-header">UTS</th>
																				<th class="table-header">UAS</th>
																				<th class="table-header">TOTAL</th>
																				<?} ?>

                                    	  </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach($faq as $k=>$v) {
                                      ?>
                                    	  <tr>

																					<script>
																					$(document).ready(function ()
																					 {
																							//called when key is pressed in textbox
																								$("#<?php echo "quantitysatu" ?><?php echo $k+1; ?>").keypress(function (e)
																									{
						 																			//if the letter is not digit then display error and don't type anything
						 																				if (e.which < 44 || e.which > 57)
																										{
																												//display error message
																												$("#errmsg").html("Angka Saja!").show().fadeOut("fast");
																												//$toast('Here you can put the text of the toast');
																												return false;
																											}
					 																			});

																								$("#<?php echo "quantitydua" ?><?php echo $k+1; ?>").keypress(function (e)
																									{
						 																			//if the letter is not digit then display error and don't type anything
						 																				if (e.which < 44 || e.which > 57)
																										{
																												//display error message
																												$("#errmsg").html("Angka Saja!").show().fadeOut("slow");
											 																	return false;
																											}
					 																			});

																								$("#<?php echo "quantitytiga" ?><?php echo $k+1; ?>").keypress(function (e)
																									{
						 																			//if the letter is not digit then display error and don't type anything
						 																				if (e.which < 44 || e.which > 57)
																										{
																												//display error message
																												$("#errmsg").html("Angka Saja!").show().fadeOut("slow");
											 																	return false;
																											}
					 																			});

																								function compute()
																								 {
    																							var harian = document.getElementById('<?php echo "quantitysatu" ?><?php echo $k+1; ?>');
    																							var uts = document.getElementById('<?php echo "quantitydua" ?><?php echo $k+1; ?>');
    																							var uas = document.getElementById('<?php echo "quantitytiga" ?><?php echo $k+1; ?>');
																									var total = document.getElementById('valueTotal<?php echo $k+1; ?>');
    																							var v1=harian.value;
    																							var v2=uts.value;
																									var v3=uas.value;
    																							var val1 = v1==="" ? 0 : parseFloat(v1); // convert string to float
    																							var val2 = v2==="" ? 0 : parseFloat(v2);
																									var val3 = v3==="" ? 0 : parseFloat(v2);
    																							total.value = val1 * val2 * val3;
																									}

																					});

																				</script>
																					  <td class="center"><?php echo $k+1; ?> </td>
                                    		    <td><?php echo $faq[$k]["nama_siswa"]; ?></td>

																						<?
																						if ($_GET[pelajaran]==1 or $_GET[pelajaran]==2 or $_GET[pelajaran]==3 ){
																							?>
																							<td onKeyUp="compute()" id="<?php echo "quantitytiga" ?><?php echo $k+1; ?>" class="center" contenteditable="true" onBlur="saveToDatabase(this,'uas','<?php echo $faq[$k]["id_nilai"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["uas"]; ?></td>

																								<?
																						}
																						else {
																							?>

																							<td onKeyUp="compute()" id="<?php echo "quantitysatu" ?><?php echo $k+1; ?>" class="center" contenteditable="true" onBlur="saveToDatabase(this,'harian','<?php echo $faq[$k]["id_nilai"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["harian"]; ?> </span></td>
	                                            <td  onKeyUp="compute()"id="<?php echo "quantitydua" ?><?php echo $k+1; ?>" class="center" contenteditable="true" onBlur="saveToDatabase(this,'uts','<?php echo $faq[$k]["id_nilai"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["uts"]; ?></td>
																							<td onKeyUp="compute()" id="<?php echo "quantitytiga" ?><?php echo $k+1; ?>" class="center" contenteditable="true" onBlur="saveToDatabase(this,'uas','<?php echo $faq[$k]["id_nilai"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["uas"]; ?></td>
																							<td contenteditable="true" onKeyUp="compute()" id="valueTotal<?php echo $k+1; ?>"></td>

																							<?
																						}
																						?>



                                        </tr>
                                    <?php



                                    }

																		if(isset($_POST['pilih']))
																		{

																		$_SESSION['pilihpelajaran']	=$_POST['pelajaran'];
																		$_SESSION['pilihkelas']			=$_POST['kelas'];
																		}



                                    ?>
                                      </tbody>
                                    </table>
