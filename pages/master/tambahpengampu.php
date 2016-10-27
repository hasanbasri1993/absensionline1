<script type="text/javascript">


    $(function () {
        'use strict';

        var countriesArray = <?php include 'searchguru.php'; ?>;

        // Initialize autocomplete with custom appendTo:
        $('#nama_guru').autocomplete({
            lookup: countriesArray
        })
    });

      $(document).ready(function(){
        //apabila terjadi event onchange terhadap object <select id=propinsi>
        $("#kelas").change(function(){
          var kelas = $("#kelas").val();
          $.ajax({
              url: "http://absen.daarululuumlido.com/pages/master/ambilpelajaranngampu.php",
              data: "kelas="+kelas,
              cache: false,
              success: function(msg){
                  $("#pelajaran").html(msg);
              }
          });
        });
      });

</script>

<title> Absensi Siswa - <?php echo sekolah; ?> </title>
 <div class="row">
     <div class="col-lg-12">
         <h1 class="page-header">Absensi</h1>
     </div>
     <!-- /.col-lg-12 -->
 </div>
 <!-- /.row -->
 <div class="row">
     <div class="col-lg-12">
         <div class="panel panel-default">
             <div class="panel-heading">
                 Input Data Absen
             </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-12">
                        <form method="post" role="form" name="form" onsubmit="return validateForm()">
                          <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="nama_guru" id="nama_guru" class="form-control"/>
                            <p class="help-block">Type min 3 to show siswa!</p>
                          </div>

                          <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control" name="kelas" id="kelas">
                              <option>--Pilih Kelas--</option>
                              <?php
                              //mengambil nama-nama propinsi yang ada di database
                              $kelas = mysql_query("
                              SELECT
                              	mata_pelajaran.kelas,
                              	pelajaran.nama_pelajaran
                              FROM
                              	mata_pelajaran
                              LEFT JOIN pelajaran ON mata_pelajaran.kode_mata_pelajaran = pelajaran.kode_pelajaran
                              ");

                              while($p=mysql_fetch_array($kelas)){
                                echo "<option value=\"".$k['kode_mata_pelajaran']."\">".$k['nama_pelajaran']."</option>\n";
                              }
                              ?>
                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>

                          <div class="form-group">
                              <label>Pelajaran</label>
                              <select class="form-control" name="pelajaran" id="pelajaran">
                              <option>--Pilih Pelajaran--</option>
                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>

                          <button type="submit" name="simpan" class="btn btn-default">Masukan</button>
                          <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                      </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
          </div>
        </div>
      </div>


 <?php

 if(isset($_POST['simpan']))

 {
   print $_POST['pelajaran'];
   print $_POST['kelas'];
   print $_POST['nama_guru'];
   print $_SESSION['id_tahun'];
   print $_SESSION['id_semester'];
    //ganti format tanggal dari datepicker ke mysql
   date_default_timezone_set('Asia/Jakarta');
   $new_date = date("Y-m-d");
   $jam = date("H:i:sa");
 		//ambil 4 karakter pertama
 		$nameonly = substr($_POST['nama_guru'], 0, 3);

 		//query cek apa udah dimasukin blom absen ini pada tanggal itu
 		$cekudahadaapabelum = mysql_query("
      SELECT * FROM pejaran_pengampu
      where
      (nid = '$nameonly' AND kode_kelas LIKE '".$_POST['kelas']."' AND kode_mata_pelajaran LIKE '".$_POST['pelajaran']."' )");
      if($cekudahadaapabelum === FALSE)
      {
        die(mysql_error()); // TODO: better error handling
      }
 			//cek apa udah dimasukin blom absen ini pada tanggal itu
 			if (mysql_num_rows($cekudahadaapabelum) > 0){
 			//if ( $cekudahadaapabelum >= 1 ) {
                 //alert kalo true
 				echo"<script>swal({ title: 'Daarul Uluum Lido',
 								text: 'Udah ada data absennya',
 								timer: 2000,
 								type:'error',
 								showConfirmButton: false });
 					</script>";
                 //insert kalo blom ada
 				} else {

 					$q1=mysql_query("Insert into pejaran_pengampu (`kode_kelas`,`nid`,`kode_mata_pelajaran`,`id_tahun_ajaran`,`id_semester`) values
 		               ('".$_POST['kelas']."','".$nameonly."','".$_POST['pelajaran']."','".$_SESSION['id_tahun']."','".$_SESSION['id_semester']."')");

 							if($q1)
 									{
 										echo"<script>swal({ title: 'Daarul Uluum Lido',
 												text: 'Absensi sudah masuk!',
 												timer: 2000,
 												type:'success',
 												showConfirmButton: false });
 											</script>";
 									}
 									else {
 											echo"<script>swal({ title: 'Daarul Uluum Lido',
 													text: 'Data ada yang error, absensi blom masuk!',
 													timer: 2000,
 													type:'error',
 													showConfirmButton: false });
 												</script>";
 										 }

 						}
 }
 ob_end_flush();
 ?>
