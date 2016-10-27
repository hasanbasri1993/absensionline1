<script type="text/javascript">


    $(function () {
        'use strict';

        var countriesArray = <?php include 'searchguru.php'; ?>;

        // Initialize autocomplete with custom appendTo:
        $('#nama_guru').autocomplete({
            lookup: countriesArray
        })
    });


    function validateForm()
    {
      var x=document.forms["form"]["nama_kelas"].value;
      var x1=document.forms["form"]["pelajaran"].value;
      var x2=document.forms["form"]["kelas"].value;
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
                        <div class="col-lg-6">
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
                              <p class="help-block">Choose the reason.</p>
                          </div>
                          </div>
                          <div class="col-lg-6">
                          <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control" name="kelas" id="kelas">
                                  <option value="1">Satu</option>
                                  <option value="2">Dua</option>
                                  <option value="3">Tiga</option>
                                  <option value="4">Empat</option>
                                  <option value="5">Lima</option>

                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>
                          </div>
                          <div id="divjurusan" class="form-group">
                              <label>Kelas</label>
                              <select class="form-control" name="jurusan" id="jurusan">
                                  <option value="umum" selected="selected">Umum</option>
                                  <option value="ipa">IPA</option>
                                  <option value="ips">IPS</option>
                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>
                          <div class="form-group">
                            <button type="submit" name="simpan" class="btn btn-default">Masukan</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </div>
                        </form>
                      </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
          </div>
        </div>
      </div>

      <script>
      $(document).ready( function() {
        $('#kelas').bind('change', function (e) {
          if( $('#kelas').val() > '3') {
            $('#divjurusan').show();
           }
          else
          {
            $('#divjurusan').hide();
      	  }
        }).trigger('change');
      });
      </script>


 <?php

 if(isset($_POST['simpan']))

 {
   print $_POST['pelajaran'];
   print $_POST['kelas'];
   print $_POST['jurusan'];
   print $_SESSION['id_tahun'];
   print $_SESSION['id_semester'];
    //ganti format tanggal dari datepicker ke mysql
   date_default_timezone_set('Asia/Jakarta');
   $new_date = date("Y-m-d");
   $jam = date("H:i:sa");
 		//ambil 4 karakter pertama
 		$nameonly = substr($_POST['nama_guru'], 0, 3);

    $kelas = $_POST['kelas'];
 		//query cek apa udah dimasukin blom absen ini pada tanggal itu
 		$cekudahadaapabelum = mysql_query("
      SELECT
        *
      FROM
        mata_pelajaran
      WHERE
      (jurusan LIKE '".$_POST['jurusan']."' AND kelas LIKE '".$_POST['kelas']."' AND kode_mata_pelajaran LIKE '".$_POST['pelajaran']."' )");
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

 					$q1=mysql_query("Insert into mata_pelajaran (`kelas`,`kode_mata_pelajaran`,`jurusan`,`id_tahun_ajaran`,`id_semester`) values
 		               ('".$_POST['kelas']."','".$_POST['pelajaran']."','".$_POST['jurusan']."','".$_SESSION['id_tahun']."','".$_SESSION['id_semester']."')");

 							if($q1)
  								{
                    $rw=mysql_query("
                      SELECT
                        *
                      FROM
                        siswa
                      LEFT JOIN kelas ON siswa.namakelas = kelas.kode_kelas
                      WHERE
                        kelas_kelas = $kelas ");
                          while($s=mysql_fetch_array($rw))
                            {
                                $q1=mysql_query("INSERT INTO nilai_santri (`nim`, `pelajaran`, `harian`, `uts`, `uas`, `id_semester`, `id_tahun_ajaran`) VALUES ('".$s['nim']."', '".$_POST['pelajaran']."', '0', '0', '0', '".$_SESSION['id_semester']."','".$_SESSION['id_tahun']."');");
                                              if($q1 === FALSE)
                                              {
                                                die(mysql_error()); // TODO: better error handling
                                              }
                            }

                       echo"<script>swal({ title: 'Daarul Uluum  ',
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
                        die(mysql_error());
 										 }

 						}
 }
 ob_end_flush();
 ?>
