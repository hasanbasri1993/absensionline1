<?
$host	 = "localhost";
$user	 = "daarulul_absen";
$pass	 = "hjve6uly";
$dabname = "daarulul_absen";

//$user	 = "root";
//$pass	 = "";
//$dabname = "absenkampusdb";
$conn = mysql_connect( $host, $user, $pass) or die("Could not connect to mysql server." );
mysql_select_db($dabname, $conn) or die("Could not select database.");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container">
        <!-- Page Content goes here -->
<h4 class="center">Laporan Abensi Siswa SMP Daarul Uluum Lido</h4>
<h5 class="center">Pada <?=date("l, Y/m/d ");?></h3>

<table id="laporan" class="bordered highlight">
                                        <thead>
                                          <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Alasan</th>
                                            <th>Tanggal</th>
                                            <th>Penginput / Piket</th>
                                            <th>Waktu Input</th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                    <?php
                                    $rw=mysql_query("
                                   SELECT
                                    *
                                   FROM
                                  	absen_siswa
                                   LEFT JOIN siswa ON absen_siswa.nim_siswa = siswa.nim
                                   LEFT JOIN guru ON absen_siswa.logged = guru.nid
                                   LEFT JOIN kelas on siswa.namakelas = kelas.kode_kelas
                                   WHERE DATE(tanggal) = DATE(now())
                                   ORDER BY
                                    izin ASC,
                                    nama_kelas ASC,
                                    nama_siswa ASC
                                   ");

                                    $counter = 1;
                                    while($s=mysql_fetch_array($rw))
                                    {
                                    ?>
                                    <tr>
                                      <td><?php echo $counter;?></td>
                                      <td>
                                        <?php echo $s['nama_siswa']; ?>
                                      </td>
                                      <td><?php echo $s['nama_kelas']; ?></td>
                                      <td><?php echo $s['izin']; ?></td>
                                      <td><?php echo $s['tanggal']; ?></td>
                                      <td><?php echo $s['nama_guru']; ?></td>
                                      <td><?php echo $s['tanggal_input']." ".$s['jam_input']; ?></td>
                                    </tr>
                                  </tbody>
                                    <?php
                                    $counter++;
                                    }
                                    ?>
                                  </table>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
