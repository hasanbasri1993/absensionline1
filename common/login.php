<?php
session_start();
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Absensi SMP</title>
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo baseurl; ?>common/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo baseurl; ?>common/bower_components/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">MASUK</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="formlogin" action="login.php?login_attempt=1" method="post">
                            <fieldset>
                                <div class="form-group input-group">
                                  <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-user"></span>
                                  </span>
                                    <input class="form-control" autocomplete="off" autofocus="on"placeholder="username" name="username" type="username">
                                </div>
                                <div class="form-group input-group">
                                  <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-asterisk"></span>
                                  </span>
                                  <input class="form-control" autocomplete="off" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Login
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?php echo baseurl; ?>common/bower_components/sweetalert/sweetalert.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>
<?php
if(isset($_GET['login_attempt']))
{
	$spf=sprintf("
                    Select
                        *
                    From
                        guru
          				  where
                        username='%s' and password='%s'",$_POST['username'],$_POST['password']
              );
	$rs=mysql_query($spf);
	$rw=mysql_fetch_array($rs);
	$rc=mysql_num_rows($rs);

	$tahunsemster=mysql_query("SELECT
		*
	FROM
		semester,
		tahun_ajaran
	WHERE
		semester.isAktif = '1'
	AND tahun_ajaran.isAktif = '1'");
if($tahunsemster === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
	$tahunsemster_row = mysql_fetch_array($tahunsemster);
	$rc1=mysql_num_rows($tahunsemster);
	if($rc==1 && $rc1==1 )
	{
		$_SESSION['nama']=$rw['nama_guru'];
		$_SESSION['user']=$rw['username'];
		$_SESSION['role']=$rw['role'];
    $user = $rw['username'];
    $namaguru = $rw['nama_guru'];
		$_SESSION['logged']=$rw['nid'];
		$_SESSION['id_semester']=$tahunsemster_row['id_semester'];
		$_SESSION['semester']=$tahunsemster_row['semester'];
		$_SESSION['id_tahun']=$tahunsemster_row['id_tahun'];
		$_SESSION['tahun']=$tahunsemster_row['tahunajaran'];
    /*$homepage = file_get_contents('https://reguler.zenziva.net/apps/smsapi.php?userkey=56yh2d&passkey=hjve6uly&nohp=082213542319&pesan=Telah%20login%20'.$namaguru);
 if (	$_SESSION['role'] === "1")
  {*/
      echo "<script>window.location= '../pages/home.php?$nid'</script>";
		//}
      //echo $homepage;
  }
  else {
    echo"<script>swal({ title: 'Daarul Uluum Lido',
            text: 'Username atau Passwordnya salah, Hubungi admin!!!',
            timer: 1000,
            type:'error',
            showConfirmButton: false });
        </script>";
  }
}

?>
