<?php

$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

$dbhost = 'localhost';
$dbuser = 'daarulul_absen';
$dbpass = 'hjve6uly';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
$path = "public_html/absen/pages/master/uploads/";
$actual_image_name="";
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	include_once 'includes/getExtension.php';
	$id_siswa = $_POST['id_siswa'];
	$imagename = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];

	if(strlen($imagename))
	{
		$ext = strtolower(getExtension($imagename));
		if(in_array($ext,$valid_formats))
		{
			if($size<(5120*5120))
			{
				mysql_connect("localhost", "daarulul_absen", "hjve6uly") or die(mysql_error());
				mysql_select_db("daarulul_absen") or die(mysql_error());
				$result = mysql_query("SELECT * FROM siswa WHERE id_siswa=$id_siswa")
				or die(mysql_error());


				while($row = mysql_fetch_array( $result ))
					{
						// Print out the contents of each row into a table
						$actual_image_name = str_replace(" ", "_", strtolower($row['nama_siswa'])).".".$ext;
						//$actual_image_name = $row['nama_siswa'].".".$ext;
					}
				$uploadedfile = $_FILES['photoimg']['tmp_name'];
				include 'includes/compressImage.php';

				$widthArray = array(150);
				foreach($widthArray as $newwidth)
				{
				$filename=compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);

				echo "<img src='".$filename."' class='img'> <br/>";
				echo "<b>Width:</b> ".$newwidth."px  <br/><b>File Name:</br> ".$filename."<br/><br/>";
				}
				if(move_uploaded_file($uploadedfile, $path.$actual_image_name))
				{
					$sql = 'UPDATE siswa
							SET photo="'.$imagename.'"
							WHERE id_siswa="'.$id_siswa.'"';

					mysql_select_db('daarulul_absen');
					$retval = mysql_query( $sql, $conn );
					if(! $retval )
					{
					  die('Could not update data: ' . mysql_error());
					}
					echo "Updated data successfully\n";
					mysql_close($conn);
				//echo "<img src='".$path.$actual_image_name."'  class='preview'><br/>";
				unlink($path.$actual_image_name);
				//echo "<b>Original Image</b>  <br/><b>File Name:</br> ".$filename."<br/><br/>";
				}
				else
				echo "Fail upload folder with read access.";
			}
			else
			echo "Image file size max 1 MB";
		}
		else
		echo "Invalid file format..";
	}
	else
	echo "Please select image..!";
	exit;
}
?>
