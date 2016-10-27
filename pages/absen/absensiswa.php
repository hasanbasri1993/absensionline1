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
                          <div class="row">

                              <div class="form-group col-lg-6">
                                <label>Nama Santri</label>
                                <select name="nama_siswa" class="pilihnama_santri form-control">
                                       <?php
                                       $kec = mysql_query(" SELECT * FROM kelas ");
                                       while($k = mysql_fetch_array($kec))
                                       {
                                       ?>
                                           <optgroup  label=<?=$k['nama_kelas'];?>>
                                             <?php
                                             $kode_kelas = $k['kode_kelas'];
                                             $santriq = mysql_query("SELECT * FROM siswa
                                                                     LEFT JOIN kelas_santri ON id_santri = siswa.nim
                                                                     LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                                                                     WHERE kode_kelas = $kode_kelas
                                                                    ");
                                             while($santri = mysql_fetch_array($santriq))
                                                  { ?>
                                                      <option value="<?=$santri['nim'];?>"><?=$santri['nama_siswa'];?></option>
                                                  <?php
                                                  }
                                                  ?>
                                           </optgroup>
                                        <?php } ?>
                                 </select>

                                <p class="help-block">Pilih dulu santrinya!</p>
                              </div>

                              <div class="col-lg-6" id="hasil"></div>
                            </div>

                          <div class="form-group">
                              <label>Alasan</label>
                              <select name="alasan"class="form-control">
                                  <option value="sakit" >Sakit</option>
                                  <option value="izin pulang">Izin Pulang</option>
                                  <option value="izin haris">Izin Haris</option>
                                  <option value="alpa">Alpa</option>
                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>
                          <div class="form-group">
                            <label>Tanggal</label>
                            <input id="tanggal" name="tanggal" class="form-control datepicker" type="text">
                            <p class="help-block">Choose the date.</p>
                          </div>

                            <div class="form-group">
                              <label>Print</label>
                              <input type="checkbox" name="print" id="print" value="1" checked> I accept Terms of Service.
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
 		//$nameonly = substr($_POST['nama_siswa'], 0, 4);

 		//query cek apa udah dimasukin blom absen ini pada tanggal itu
 		$cekudahadaapabelum = mysql_query("SELECT * FROM absen_siswa where (nim_siswa = '".$_POST['nama_siswa']."' AND tanggal LIKE '".$_POST['tanggal']."')");
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

 					$q1=mysql_query("Insert into absen_siswa (`nim_siswa`,`izin`,`tanggal`,`logged`,`id_tahun_ajaran`,`id_semester`,`tanggal_input`,`jam_input`) values
 		               ('".$_POST['nama_siswa']."','".$_POST['alasan']."','".$_POST['tanggal']."','".$_SESSION['logged']."','".$_SESSION['id_tahun']."','".$_SESSION['id_semester']."','".$new_date."','".$jam."')");

 							if($q1)
 									{
                    if(isset($_POST['print'])) {
                      if ($_POST['alasan'] != 'Alpa') {
                        //echo '<script type="text/javascript" language="javascript">
                              //  var stile = "top=10, left=10, status=no, menubar=no, toolbar=no scrollbar=no";
                              //  var win = window.open("");
                              //  win.focus();
                              //</script>';
                              $result = mysql_query("
                              SELECT
                                id_data
                              FROM
                              	absen_siswa
                              ORDER BY
                              	id_data DESC
                              LIMIT 1");
                              if (!$result) {
                                  echo 'Could not run query: ' . mysql_error();
                                  exit;
                              }
                              $row = mysql_fetch_row($result);

                              $url = "http://absen.daarululuumlido.com/pages/tasreh/index.php?id=".$row[0]; // 42
                              echo '<script type="text/javascript" language="javascript">
                                      var stile = "top=10, left=10, status=no, menubar=no, toolbar=no scrollbar=no";
                                      window.open("'.$url.'","", stile);
                                    </script>';
                            }
                          }

 									}
 									else {
                    echo"<script>swal({ title: 'Daarul Uluum Lido',
                        text: 'Absensi tidak masuk!',
                        timer: 2000,
                        type:'success',
                        showConfirmButton: false });
                      </script>";

 										 }

 						}



 }
 ob_end_flush();
?>


 <script type="text/javascript">

 $(document).ready(function() {
   $(".pilihnama_santri").select2();
 });

    $('#tanggal').pickadate(
           {
             format: 'yyyy-mm-dd'
           }
         )


     function validateForm()
     {
       var x=document.forms["form"]["nama_siswa"].value;
       var x1=document.forms["form"]["alasan"].value;
       var x2=document.forms["form"]["tanggal"].value;
         if (x==null || x=="")
           {
             swal({ title: "<?php echo sekolah;?>",
             text: "Namanya jgn kosong",
             timer: 2000,
             type:"error",
             showConfirmButton: false
             });
             return false;
           }
       if (x1==null || x1=="")
         {
           swal({ title: "<?php echo sekolah;?>",
           text: "nama gk kosng 2",
           timer: 2000,
           type:"error",
           showConfirmButton: false
           });
           return false;
         }
       if (x2==null || x2=="")
         {
           swal({ title: "<?php echo sekolah;?>",
           text: "Tanggal jangan lupa diisi",
           timer: 2000,
           type:"error",
           showConfirmButton: false
           });
           return false;
         }
       }

           $(document).ready(function() {
             $(".pilihnama_santri").select2();
           });


           $(".pilihnama_santri").change(function(){
             var kelas = $(".pilihnama_santri").val();
             $.ajax({
               url: "http://absen.daarululuumlido.com/pages/absen/cekabssisiswa.php",
                 data: "nim="+kelas,
                 cache: false,
                 success: function(msg){
                     $("#hasil").html(msg);
                 }
             });
           });
 </script>
