<script type="text/javascript">


    $(function () {
        'use strict';

        var countriesArray = <?php include 'searchsiswa.php'; ?>;

        // Initialize autocomplete with custom appendTo:
        $('#nama_siswa').autocomplete({
            lookup: countriesArray
        })
        $('#tanggal').pickadate(
          {

            disable: [
                 1, 4, 7
                ],
            format: 'yyyy-mm-dd'

          }
        )
    });

</script>
<title> Rekap Susulan UAS - <?php echo sekolah; ?> </title>
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
                 Input Data Rekap Susulan
             </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-12">
                        <form method="post" role="form" name="form" onsubmit="return validateForm()">
                          <div class="form-group">
                            <label>Nama Santri</label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control"/>
                            <p class="help-block">Type min 3 to show siswa!</p>
                          </div>
                          <div class="form-group">
                              <label>Jam ke-</label>
                              <select name="jamke"class="form-control">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                              </select>
                              <p class="help-block">Jam ke-</p>
                          </div>
                          <div class="form-group">
                              <label>Pelajaran</label>
                              <select class="form-control" name="pelajaran" id="pelajaran">
                                <?php
                                $q=mysql_query("Select * from pelajaran");
                                while($r=mysql_fetch_array($q))
                                  {
                                ?>
                                    <option value="<?php echo $r['kode_pelajaran']; ?>"><?php echo $r['nama_pelajaran']; ?></option>
                                <?php
                                  }
                                  ?>
                              </select>
                              <p class="help-block">Pelajaran</p>
                          </div>
                          <div class="form-group">
                            <label>Tanggal</label>
                            <input id="tanggal" name="tanggal" class="form-control datepicker" type="text">
                            <p class="help-block">Choose the date.</p>
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
    //ganti format tanggal dari datepicker ke mysql
   date_default_timezone_set('Asia/Jakarta');
   $new_date = date("Y-m-d");
   $jam = date("H:i:sa");
 		//ambil 4 karakter pertama
 		$nameonly = substr($_POST['nama_siswa'], 0, 4);

 		//query cek apa udah dimasukin blom absen ini pada tanggal itu
 		$cekudahadaapabelum = mysql_query("SELECT * FROM rekap_susulan where (id_siswa = '$nameonly' AND jam_ke = '".$_POST['jamke']."' AND tanggal LIKE '".$_POST['tanggal']."')");
 			//cek apa udah dimasukin blom absen ini pada tanggal itu
 			if (mysql_num_rows($cekudahadaapabelum) > 0){
 			//if ( $cekudahadaapabelum >= 1 ) {
                 //alert kalo true
 				echo"<script>swal({ title: 'Daarul Uluum Lido',
 								text: 'Rekap Susulan ini sudah ada.',
 								timer: 2000,
 								type:'error',
 								showConfirmButton: false });
 					</script>";
                 //insert kalo blom ada
 				} else {

 					$q1=mysql_query("Insert into rekap_susulan (`id_siswa`,`tanggal`,`jam_ke`,`pelajaran`) values
 		               ('".$nameonly."','".$_POST['tanggal']."','".$_POST['jamke']."','".$_POST['pelajaran']."')");

                   if($q1 === FALSE)
                   {
                     die(mysql_error()); // TODO: better error handling
                   }

 							if($q1)
 									{
 										echo"<script>swal({ title: 'Daarul Uluum Lido',
 												text: 'Rekapnya sudah masuk!',
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
