
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
                        <form method="post" role="form" name="form">
                          <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="nama_guru" id="nama_guru" class="form-control"/>
                            <p class="help-block">Type min 3 to show siswa!</p>
                          </div>
                          <div  class="form-group">
                              <label>Jam Ke</label>
                              <select name="jamke"class="form-control">
                                  <?php
                                    for ($x = 0; $x <= 9; $x++) {
                                        echo "<option>$x</option> <br>";
                                    }
                                  ?>
                              </select>
                              <p class="help-block">Choose the reason.</p>

                              <select class="form-control" name="kelas" id="kelas">
                              <option>--Pilih Kelas--</option>
                              <?php
                              //mengambil nama-nama propinsi yang ada di database
                              $kelas = mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
                              while($p=mysql_fetch_array($kelas)){
                              echo "<option value=\"$p[kode_kelas]\">$p[nama_kelas]</option>\n";
                              }
                              ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Alasan</label>
                              <select name="izin"class="form-control">
                                  <option value="Sakit">Sakit</option>
                                  <option value="Izin Pribadi">Izin Pribadi</option>
                                  <option value="Izin Dinas">Izin Dinas</option>
                                  <option value="Alpa">Alpa</option>
                              </select>
                              <p class="help-block">Choose the reason.</p>
                          </div>

                          <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control"/>
                            <p class="help-block"></p>
                          </div>

                          <div class="form-group">
                            <label>Tanggal</label>
                            <input id="tanggal" name="tanggal" class="form-control datepicker" type="text">
                            <p class="help-block">Choose the date.</p>
                          </div>

                          <h2>Guru Pengganti</h2>

                          <div class="form-group">
                            <label>Nama Guru Pengganti</label>
                            <input type="text" name="guru_pengganti" id="guru_pengganti" class="form-control"/>
                            <p class="help-block">Type min 3 to show siswa!</p>
                          </div>

                          <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control" name="matapelajaran" id="matapelajaran">
                              <option>--Pilih Kelas--</option>
                              <?php
                              //mengambil nama-nama propinsi yang ada di database
                                $kelas = mysql_query("SELECT * FROM pelajaran ORDER BY nama_pelajaran");
                                while($p=mysql_fetch_array($kelas)){
                                echo "<option value=\"$p[kode_pelajaran]\">$p[nama_pelajaran]</option>\n";
                              }
                              ?>
                            </select>
                            <p class="help-block"></p>
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
 		$nameguruabsenonly = substr($_POST['nama_guru'], 0, 3);
    $namegurupenggantionly = substr($_POST['guru_pengganti'], 0, 3);


 		//query cek apa udah dimasukin blom absen ini pada tanggal itu
 		/*$cekudahadaapabelum = mysql_query("SELECT * FROM absen_guru where (nim_siswa = '$nameonly' AND tanggal LIKE '".$_POST['tanggal']."')");
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

 					*/$q1=mysql_query("Insert into absen_guru
                               (
                                 `nid_guru`,
                                 `tanggal`,
                                 `jamke`,
                                 `kelas`,
                                 `izin`,
                                 `keterangan`,
                                 `pengganti`,
                                 `matapelajaran`,
                                 `piket_logged`,
                                 `id_tahun_pelajaran`,
                                 `id_semester`,
                                 `tanggal_input`
                               )
                           values
     		                       (
                                     '".$nameguruabsenonly."',
                                     '".$_POST['tanggal']."',
                                     '".$_POST['jamke']."',
                                     '".$_POST['kelas']."',
                                     '".$_POST['izin']."',
                                     '".$_POST['keterangan']."',
                                     '".$namegurupenggantionly."',
                                     '".$_POST['matapelajaran']."',
                                     '".$_SESSION['logged']."',
                                     '".$_SESSION['id_tahun']."',
                                     '".$_SESSION['id_semester']."',
                                     '".$new_date."'
                               )
                            ");
                            if($q1 === FALSE)
                                   {
                                     die(mysql_error()); // TODO: better error handling
                                   }

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

 						//}



 }
 ob_end_flush();
 ?>
 <script type="text/javascript">

     $(function () {
         'use strict';

         var countriesArray = <?php include 'searchguru.php'; ?>;

         // Initialize autocomplete with custom appendTo:
         $('#nama_guru').autocomplete({
             lookup: countriesArray
         })

         $('#guru_pengganti').autocomplete({
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


    /* $( function() {
       $.widget( "custom.catcomplete", $.ui.autocomplete, {
         _create: function() {
           this._super();
           this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
         },
         _renderMenu: function( ul, items ) {
           var that = this,
             currentCategory = "";
           $.each( items, function( index, item ) {
             var li;
             if ( item.KELAS != currentCategory ) {
               ul.append( "<li class='ui-autocomplete-category'>" + item.KELAS + "</li>" );
               currentCategory = item.KELAS;
             }
             li = that._renderItemData( ul, item );
             if ( item.KELAS ) {
               li.attr( "aria-label", item.KELAS + " : " + item.NAMASISWA );
             }
           });
         }
       });
       var data = <?php// include 'searchsiswa.php'; ?>;

       $( "#nama_guru" ).catcomplete({
         delay: 0,
         source: data
       });
     } );*/


     function validateForm()
     {
       var x=document.forms["form"]["nama_guru"].value;
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
 </script>
