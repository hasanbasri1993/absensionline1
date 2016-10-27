<?php
$qkelas=mysql_query("SELECT count(nama_kelas) as nama_kelas from kelas");
$datakelas=mysql_fetch_assoc($qkelas);

$qsiswa=mysql_query("SELECT count(nama_siswa) as jumlahsiswa from siswa");
$datasiswa=mysql_fetch_assoc($qsiswa);

   $now = new \DateTime('now');
   $month = $now->format('m');
   $year = $now->format('Y');

$qsakit=mysql_query("SELECT count(izin) as sakit from absen_siswa
					WHERE Month(tanggal) = Month(now()) and izin = 'sakit'");
$datasakit=mysql_fetch_assoc($qsakit);

$qalfa=mysql_query("SELECT count(izin) as alfa from absen_siswa
					WHERE Month(tanggal) = Month(now()) and izin = 'alpa'");
$dataalfa=mysql_fetch_assoc($qalfa);

$qizinpulang=mysql_query("SELECT count(izin) as izinpulang from absen_siswa
					WHERE Month(tanggal) = Month(now()) and izin = 'izin pulang'");
$dataizinpulang=mysql_fetch_assoc($qizinpulang);

$qizinharis=mysql_query("SELECT count(izin) as izinharis from absen_siswa
					WHERE Month(tanggal) = Month(now()) and izin = 'izin haris'");
$dataizinharis=mysql_fetch_assoc($qizinharis);

$alpaterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kelas.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINPULANG',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINHARIS',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
LEFT JOIN kelas_santri ON id_santri = s.nim
LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
ORDER BY
ALPHA DESC
LIMIT 1
");


$sakitterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINPULANG',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINHARIS',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
LEFT JOIN kelas_santri ON id_santri = s.nim
LEFT JOIN kelas kls ON kode_kelas = kelas_santri.id_kelas
ORDER BY
SAKIT DESC
LIMIT 1
");


$iziharisnterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINPULANG',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINHARIS',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
LEFT JOIN kelas_santri ON id_santri = s.nim
LEFT JOIN kelas kls ON kode_kelas = kelas_santri.id_kelas
ORDER BY
IZINHARIS DESC
LIMIT 1
");

$izipulangnterbanyak=mysql_query("
SELECT s.nama_siswa 'NAMA SISWA',
s.jeniskelamin 'L/P',kls.nama_kelas,
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINPULANG',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'IZINHARIS',
IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND MONTH(a.tanggal) = MONTH(now()) GROUP BY a.nim_siswa),0) 'ALPHA'
FROM siswa s
LEFT JOIN kelas_santri ON id_santri = s.nim
LEFT JOIN kelas kls ON kode_kelas = kelas_santri.id_kelas
ORDER BY
IZINPULANG DESC
LIMIT 1
");



?>
<title> Dashboard - <?php echo sekolah; ?> </title>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php echo $dataizinharis['izinharis'];?></div>
                                  <div>Izin Haris bulan ini</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="#">
                                <span class="pull-left">View Details</span>
                                </a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $dataizinpulang['izinpulang'];?></div>
                                    <div>Izin Pulang bulan ini</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="?cat=master&page=siswa">
                                <span class="pull-left">View Details</span>
                                </a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-flash fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $dataalfa['alfa'];?></div>
                                    <div>Alpa Bulai Ini</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hospital-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $datasakit['sakit'];?></div>
                                    <div>Sakit Bulan Ini</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="?cat=absen&page=lapsiswa">
                                <span class="pull-left">View Details</span>
                                </a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Panel Informasi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <p href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Tahun Ajaran
                                    <span class="pull-right text-muted small"><em><?php echo $_SESSION['tahun']; ?></em>
                                    </span>
                                </p>
                                <p href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Semester
                                    <span class="pull-right text-muted small"><em><?php echo $_SESSION['semester']; ?></em>
                                    </span>
                                </p>
                                <p href="#" class="list-group-item">
                                    <i class="fa fa-hospital-o fa-fw"></i> Sakit Terbayak
                                    <span class="pull-right text-muted small">
                                      <em>
                                        <?php while($s=mysql_fetch_array($sakitterbanyak))
                                        {
                                          echo $s['NAMA SISWA'],'  ',$s['SAKIT'],' Hari',' Kelas:', $s['nama_kelas'];;
                                        }
                                          ?>
                                      </em>
                                    </span>
                                </p>
                                <p href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Alpa Terbayak
                                    <span class="pull-right text-muted small">
                                        <em>
                                          <?php while($s=mysql_fetch_array($alpaterbanyak))
                                          {
                                            echo $s['NAMA SISWA'],'  ',$s['ALPHA'],' Hari',' Kelas:', $s['nama_kelas'];
                                          }
                                            ?>
                                        </em>
                                    </span>
                                </p>
                                <p href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> Izin Pulang Terbayak
                                    <span class="pull-right text-muted small">
                                      <em>
                                        <?php while($s=mysql_fetch_array($izipulangnterbanyak))
                                        {
                                          echo $s['NAMA SISWA'],'  ',$s['IZINPULANG'],' Hari',' Kelas:', $s['nama_kelas'];;
                                        }
                                          ?>
                                      </em>
                                    </span>
                                </p>

                            </div>
                            <!-- /.list-group -->

                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
