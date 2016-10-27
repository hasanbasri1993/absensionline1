<script>
$(function() {
    $(document).on('mouseenter.collapse', '[data-toggle=collapse]', function(e) {
        var $this = $(this),
            href, target = $this.attr('data-target') || e.preventDefault() || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
            ,
            option = $(target).hasClass('in') ? 'hide' : "show"
            $('.panel-collapse').not(target).collapse("hide")
            $(target).collapse(option);
    })
});

</script>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle"  data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php"><?php echo 'Selamat Datang  '.$_SESSION['nama']; ?></a>
    </div>
    <?php include 'navtop.php'; ?>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav collapse navbar-collapse" data-target=".navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo baseurl;?>pages/home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <?php
                if($role[0] ==='1')
                { ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Admin<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                          <a href="?cat=admin&page=adduser">Add User</a>
                      </li>
                        <li>
                            <a href="?cat=admin&page=user">User Management</a>
                        </li>
                        <li>
                            <a href="?cat=admin&page=role">Role Management</a>
                        </li>
                      </ul>
                </li>
                  <?php } ?>
                       <?php
                        if($role[0] ==='1')
                        { ?>
                <li>
                    <a><i class="fa fa-wrench fa-fw"></i> Data Master<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="?cat=master&page=tahunajaran">Set Tahun Ajaran</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=semester">Set Semester</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=pelajaran">Data Pelarajan</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=pelajarankelas">Data Pelarajan Kelas</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=siswa">Data Siswa</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=guru">Data Guru</a>
                        </li>
                        <li>
                            <a href="?cat=master&page=pengampu">Data Pengampu Pelajaran</a>
                        </li>
                     </ul>
                  </li>
                       <?php
                        }
                        ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Absensi<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level" >
                        <li>
                            <a href="?cat=absen&page=absensiswa">Input Absen Siswa</a>
                        </li>
                        <li>
                            <a href="?cat=absen&page=absenguru">Input Absen Guru</a>
                        </li>
                         <?php
                        if($role[0] =='1' OR  $role[0] == '4' OR  $role[0] == '5')
                        { ?>

                        <li>
                            <a href="?cat=absen&page=lapguru">Laporan Absen Guru Harian</a>
                        </li>

                        <li>
                            <a href="?cat=absen&page=lapabsengurupilih">Laporan Absen Guru</a>
                        </li>

                        <li>
                              <a href="?cat=absen&page=lapsiswa">Laporan Absen Siswa</a>
                        </li>
                        <li>
                            <a href="?cat=absen&page=lapabsenkelas">Laporan Absen PerKelas</a>
                        </li>
                        <li>
                            <a href="?cat=absen&page=lapabsenkelas-1">Laporan Absen PerKelas Before Sep</a>
                        </li>

                          <?php
                          }
                          ?>
                      </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php
                if($role[0] ==='1')
                { ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Nilai<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="?cat=nilai&page=inputnilai">Input Nilai</a>
                        </li>
                        <li>
                            <a href="?cat=absen&page=rekapsusulan"><i class="fa fa-dashboard fa-fw"></i> Input Rekap Susulan</a>
                        </li>
                      </ul>
                </li>
                  <?php } ?>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
