<?php
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from guru where sha1(username)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);

?>
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
                            <input type="text" name="nama_guru" value="<?php echo $row['nama_guru']; ?>" id="nama_guru" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>"class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Password Lama</label>
                            <input type="text" name="old_password" id="old_password" value="<?php echo $row['password']; ?>" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label>Password Baru</label>
                            <input type="text" name="new_password" id="new_password" class="form-control"/>
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
}
 if(isset($_POST['simpan']))
 {
 	$sc1=sprintf("Select * from guru where username='%s' and password='%s'",$_POST['username'],$_POST['old_password']);
 	$q1=mysql_query($sc1);
 	$rc1=mysql_num_rows($q1);
 	if($rc1==1)
 	{
 		$sc2=sprintf("Update guru Set password='%s' Where username='%s'",$_POST['new_password'],$_POST['username']);
 		$q2=mysql_query($sc2);
 		if($q2)
 		{
			echo"<script>swal({ title: 'Daarul Uluum Lido',
 								text: 'Password berhasil dirubah!',
 								timer: 2000,
 								type:'success',
 								showConfirmButton: false });

								window.location='?cat=admin&page=user'
 				 </script>";

 		}
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
