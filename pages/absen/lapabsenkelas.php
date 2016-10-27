	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

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
                            Laporan Absensi Siswa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <form role="form" name="pilih" method="post">
                                <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <input id="daritanggal" placeholder="Dari tanggal"name="daritanggal" class="form-control datepicker" type="text">

                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <input id="sampaitanggal" placeholder="Sampai tanggal"name="sampaitanggal" class="form-control datepicker" type="text">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Pilih Kelas</label>
                                  <select class="form-control" name="kelas" id="kelas">
																	        <option value=""> --Pilih Kelas-- </option>
																	        <option value="1">Satu</option>
                                          <option value="2">Dua</option>
                                          <option value="3">Tiga</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Pilih Rombel</label>
                                  <select class="form-control" name="rombel" id="rombel">
                                    <option value="">--Pilih Rombel--</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <div class="form-group">
                                  <button  name="tampilkan" type="submit" class="form-control btn btn-primary">Submit</button>
                                </div>
                              </form>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>SAKIT</th>
                                            <th>IZIN PULANG</th>
																						<th>IZIN HARIS</th>
                                            <th>ALPA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tr>
                                    <?php
                                    if(isset($_POST['tampilkan']))
                                    {
                                      $daritanggal =  $_POST['daritanggal'];
                                      $sampaitanggal = $_POST['sampaitanggal'];
                                      $kelas = $_POST['kelas'];
                                      $rombel = $_POST['rombel'];
                                      setcookie('DariTanggal', $daritanggal, time() + (3600), "/");
                                      setcookie('SampaiTanggal', $sampaitanggal, time() + (3600), "/");
                                      setcookie('Kelas', $kelas, time() + (3600), "/");
                                      setcookie('Rombel', $rombel, time() + (3600), "/");

                                      if (!empty($kelas) and $rombel == NULL ) {
                                        $rw=mysql_query("
                                        SELECT s.nama_siswa 'NAMA SISWA',
                                        s.jeniskelamin 'L/P',kelas.nama_kelas,
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZIN',
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
                                        FROM siswa s
                                        LEFT JOIN kelas_santri ON id_santri = s.nim
                                        LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                                        WHERE kelas_kelas = $kelas
                                        ORDER BY
                                        kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
                                        ");
                                      } elseif (!empty($kelas) and !empty($rombel) ) {
                                        $rw=mysql_query("
                                        SELECT s.nama_siswa 'NAMA SISWA',
                                        s.jeniskelamin 'L/P',kelas.nama_kelas,
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZINPULANG',
																				IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZINHARIS',
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
                                        FROM siswa s
                                        LEFT JOIN kelas_santri ON id_santri = s.nim
                                        LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                                        WHERE kelas_kelas = $kelas AND kode_kelas = $rombel
                                        ORDER BY
                                        kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
                                        ");
                                      } else {
                                        $rw=mysql_query("


                                        SELECT s.nama_siswa 'NAMA SISWA',
                                        s.jeniskelamin 'L/P',kelas.nama_kelas,
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'SAKIT',
																				IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZINPULANG',
																				IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'IZINHARIS',
                                        IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND a.tanggal between '".$daritanggal."' and '".$sampaitanggal."' GROUP BY a.nim_siswa),0) 'ALPA'
                                        FROM siswa s
                                        LEFT JOIN kelas_santri ON id_santri = s.nim
                                        LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
                                        ORDER BY
                                        kelas_kelas ASC, nama_kelas ASC, `NAMA SISWA` ASC
                                        ");
                                      }
                                     $counter = 1;
                                      if (!$rw) {
                                        die('Invalid query: ' . mysql_error());
                                            }
                                              while($s=mysql_fetch_array($rw))
                                              {
                                                ?>
                                                <tr>
                                                  <td><?php echo $counter; ?></td>
                                                  <td><?php echo $s['NAMA SISWA']; ?></td>
                                                  <td style="display: flex;"><?php echo $s['nama_kelas']; ?></td>
                                                  <td><?php echo $s['SAKIT']; ?></td>
                                                  <td><?php echo $s['IZINPULANG']; ?></td>
																									<td><?php echo $s['IZINHARIS']; ?></td>
                                                  <td><?php echo $s['ALPA']; ?></td>
                                                </tr>
                                                <?php
                                                $counter++;
                                              }
                                            }
                                            ?>
                                  </table>
                                  <script>
                                  $(document).ready(function(){
                                    //apabila terjadi event onchange terhadap object <select id=propinsi>
                                    $("#kelas").change(function(){
                                      var kelas = $("#kelas").val();
                                      $.ajax({
                                          url: "http://absen.daarululuumlido.com/pages/absen/ambilrombel.php",
                                          data: "kelas="+kelas,
                                          cache: false,
                                          success: function(msg){
                                              $("#rombel").html(msg);
                                          }
                                      });
                                    });
                                  });
                                  $(document).ready(function() {
                                      $('#dataTables-example').DataTable({
                                        dom: 'Bfrtip',
                                        scrollX: true,
																				buttons: [
																		        {
																		            extend: 'excelHtml5',
																		            text: 'Export Ke Excel',
																		            customize: function( xlsx ) {
																		                var sheet = xlsx.xl.worksheets['sheet1.xml'];
																		                $('row:first c', sheet).attr( 's', '42' );
																		            }
																		        }
																		    ]
                                      });

                                      $('#daritanggal').pickadate(
                                        {

                                          format: 'yyyy-mm-dd'

                                        }
                                      )

                                      $('#sampaitanggal').pickadate(
                                        {

                                          format: 'yyyy-mm-dd'

                                        }
                                      )
                                  });
                                  </script>
