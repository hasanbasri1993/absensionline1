<?php
session_start();
$pizza  = $_SESSION['role'];
$role = explode(" ", $pizza);
if(!isset($_SESSION['role']))
{
	echo "<script>window.location='http://absen.daarululuumlido.com/common/login.php'</script>";
}
include 'config/db.php';
?>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/x-icon" href="http://daarululuumlido.com/berkas/2015/08/logo-du-cl-retouch.png">
    <!-- Bootstrap Core CSS -->

    <link href="<?php echo baseurl; ?>common/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo baseurl; ?>common/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo baseurl; ?>common/dist/css/timeline.css" rel="stylesheet">
  	<!-- Custom CSS -->
    <link href="<?php echo baseurl; ?>common/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="<?php echo baseurl; ?>common/bower_components/pickdate/themes/pickadate.01.default.css" rel="stylesheet" id="theme_base">
		<link href="<?php echo baseurl; ?>common/bower_components/jsauto/styles.css" rel="stylesheet">
		<link href="<?php echo baseurl; ?>common/bower_components/toast/jquery.toast.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <!-- Morris Charts CSS -->
    <link href="<?php echo baseurl; ?>common/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo baseurl; ?>common/bower_components/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo baseurl; ?>common/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- DataTables CSS -->
		<link href="<?php echo baseurl; ?>common/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

		<!-- DataTables Responsive CSS -->
		<link href="<?php echo baseurl; ?>common/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">

		<script src="<?php echo baseurl; ?>common/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
		<script src="<?php echo baseurl; ?>common/bower_components/pickdate/source/pickadate.min.js"></script>
	  <script src="<?php echo baseurl; ?>common/bower_components/pickdate/source/pickadate.legacy.min.js"></script>
		<script src="<?php echo baseurl; ?>common/bower_components/jsauto/jquery.autocomplete.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo baseurl; ?>common/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Metis Menu Plugin JavaScript -->
		<script src="<?php echo baseurl; ?>common/bower_components/metisMenu/dist/metisMenu.min.js"></script>

		<!-- DataTables JavaScript -->
		<script src="<?php echo baseurl; ?>common/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo baseurl; ?>common/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="<?php echo baseurl; ?>common/dist/js/sb-admin-2.js"></script>
	  <script src="<?php echo baseurl; ?>common/bower_components/sweetalert/sweetalert.min.js"></script>
		<script src="<?php echo baseurl; ?>common/bower_components/toast/jquery.toast.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

		<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="wrapper">
        <?php
        include '../common/nav.php';
        ?>
        <div id="page-wrapper">
