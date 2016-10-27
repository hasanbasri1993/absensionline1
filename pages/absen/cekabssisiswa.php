<?php

      mysql_connect("localhost","daarulul_absen","hjve6uly");
      mysql_select_db("daarulul_absen");

      $nim = $_GET['nim'];
      $rw=mysql_query("
      SELECT s.nama_siswa 'NAMA SISWA',
      s.photo 'FOTO',
      s.jeniskelamin 'L/P',kelas.nama_kelas,
      IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'sakit' AND a.nim_siswa=s.nim AND Month(tanggal) = Month(now()) GROUP BY a.nim_siswa),0) 'SAKIT',
      IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin pulang' AND a.nim_siswa=s.nim AND Month(tanggal) = Month(now()) GROUP BY a.nim_siswa),0) 'IZIN PULANG',
      IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin haris' AND a.nim_siswa=s.nim AND Month(tanggal) = Month(now()) GROUP BY a.nim_siswa),0) 'IZIN HARIS',
      IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'izin' AND a.nim_siswa=s.nim AND Month(tanggal) = Month(now()) GROUP BY a.nim_siswa),0) 'IZIN',
      IFNULL((SELECT COUNT(*) FROM absen_siswa a WHERE a.izin = 'alpa' AND a.nim_siswa=s.nim AND Month(tanggal) = Month(now()) GROUP BY a.nim_siswa),0) 'ALPA'
      FROM siswa s
      LEFT JOIN kelas_santri ON id_santri = s.nim
      LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
      WHERE nim = $nim
      ");
      while($s=mysql_fetch_array($rw))
      {
        ?>
        <table class="table">
          <tr>
            <td rowspan="5">
              <img src="http://absen.daarululuumlido.com/pages/master/uploadfoto/uploads/150_<?php echo $s['FOTO']; ?>"  height="150px"/>
            </td>
            <td>Sakit: <?php echo $s['SAKIT']; ?></td>
         </tr>
          <tr>
            <td>Izin: <b><?php echo $s['IZIN']; ?></b></td>
          </tr>
          <tr>
            <td>Izin Pulang: <?php echo $s['IZIN PULANG']; ?></td>
          </tr>
          <tr>
            <td>Izin Haris: <?php echo $s['IZIN HARIS']; ?></td>
          </tr>
          <tr>
            <td>Alpa: <?php echo $s['ALPA']; ?></td>
          </tr>
        </table>
        <?php
    }
