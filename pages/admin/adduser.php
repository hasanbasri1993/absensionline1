<script type="text/javascript">
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
</script>
 <div class="row">
     <div class="col-lg-12">
         <h1 class="page-header">Pengguna</h1>
     </div>
     <!-- /.col-lg-12 -->
 </div>
 <!-- /.row -->
 <div class="row">
     <div class="col-lg-12">
         <div class="panel panel-default">
             <div class="panel-heading">
                 Ganti Password
             </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-12">
                        <form method="post" role="form" name="form" onsubmit="return validateForm()">
                          <div class="form-group">
                            <label>Nama </label>
                            <input type="text" name="nama_guru" value="" id="nama_guru" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label>NID </label>
                            <input type="text" name="nid" value="" id="nid" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" value=""class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" id="password" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role">

                              <option value="1">Staff</option>
                              <option value="2">BPPK</option>
                              <option value="3">BPPK</option>
                              <option value="4">BPPK</option>
                              <option value="5">BPPK</option>

                            </select>

                          </div>
                          <button type="submit" name="simpan" class="btn btn-default">Submit Button</button>
                          <button type="reset" class="btn btn-default">Reset Button</button>
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
 	$q1=mysql_query("Insert into guru (`nid`,`nama_guru`,`username`,`password`,`role`) values
                 ('".$_POST['nid']."','".$_POST['nama_guru']."','".$_POST['username']."','".$_POST['password']."','".$_POST['role']."')");

          if($q1 === FALSE)
                 {
                   die(mysql_error()); // TODO: better error handling
                 }
           if($q1)
         		{
        			echo"<script>swal({ title: 'Daarul Uluum Lido',
         								text: 'Password berhasil dirubah!',
         								timer: 2000,
         								type:'success',
         								showConfirmButton: false });

        								window.location='?cat=admin&page=user'
         				 </script>";


         	  }else{
         		echo "<script>swal({ title: 'Daarul Uluum Lido',
         								text: 'Password gagal dirubah!',
         								timer: 2000,
         								type:'error',
         								showConfirmButton: false });
         				 </script>";
                }
}
 ?>
