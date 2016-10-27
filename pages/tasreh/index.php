<?php

mysql_connect("localhost", "daarulul_absen", "hjve6uly");
mysql_select_db("daarulul_absen");

$rw = mysql_query("
SELECT
	absen_siswa.tanggal AS tanggalizin,
	siswa.nama_siswa,
	kelas.nama_kelas,
	absen_siswa.izin
FROM
	absen_siswa
LEFT JOIN siswa ON absen_siswa.nim_siswa = siswa.nim
LEFT JOIN guru ON absen_siswa.logged = guru.nid
LEFT JOIN kelas_santri ON id_santri = siswa.nim
LEFT JOIN kelas ON kode_kelas = kelas_santri.id_kelas
ORDER BY
	id_data DESC
LIMIT 1
	");



while ($s = mysql_fetch_array($rw)) {

    $newDate = date("l, d F Y", strtotime( $s['tanggalizin']));
    ?>
    <head>
        <link href="bootstrap/css/tasreh.css" rel="stylesheet">
        <title>Tashreh - <?php echo $s['nama_siswa']; ?></title>
    </head>

    <body onload="print()">
        <link href="assest/style.css" rel="stylesheet" type="text/css" />
        <div id="dvContents" class="container">

            <page size="A6">
                <table align="center">
                    <tr>
                        <td valign="top">
                            <img src="bootstrap/img/yayasan.png" height="80mm">
                        </td>
                        <td align="center">
                            &nbsp;&nbsp;
                        </td>
                        <td  align="center">
                            <h5 class="text-center" style="color:#3906CA; line-height:1.5em;">
                                <span style="font-size:14pt;">YAYASAN SALSABILA LIDO</span></br>
                                <span style="font-size:14pt;">SMP DAARUL ULUUM LIDO</span></br>
                                <span style="font-size:6pt;line-height:1.2em;">
                                    <b>STATUS :TERAKREDITASI “A” Nomor : 02.00/348/BAP-SM/XII/2013</b></br>
                                    Jl. Mayjen HR. Edi Sukma KM.22 Muara  Ciburuy Cigombong Bogor 16740,</br>
                                    &#9742; 0251 – 8224754 / 8221305
                                </span>
                                <img width="300" height="3" src="bootstrap/img/list.gif"/>
                            </h5>

                        </td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <h3><p class="arab" align="center">السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ</p></h3>
                        <p>With Regards,</p>
                    </div>
                </div>
                <p>We hereby inform Mr. / Mrs. / Miss.Teacher/ Class Guardian that the student follows : </p>
                <table>
                    <tr>
                        <td><p>Name</p></td><td><p>:</p></td><td><p><?php echo $s['nama_siswa']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p>Class</p></td><td><p>:</p></td><td><p><?php echo $s['nama_kelas']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p>Room / Dorm</td><td><p>:</p></td><td><p> - </p></td>
                    </tr>
                </table>
                <p>Can not follow the lesson as it should since <?php echo $newDate;?> because of:</p>
                <p>( <?php
										    if ($s['izin'] == 'sakit') {
										        echo " &#10004; ";
										    } else {
										        echo "&nbsp;&nbsp;&nbsp;";
										    }
										    ?>
                    ) Sick
                </p>
                <p>( <?php
                if ($s['izin'] == 'Izin' OR $s['izin'] == 'izin haris' OR $s['izin'] == 'izin pulang') {
                    echo " &#10004; ";
                } else {
                    echo "&nbsp;&nbsp;&nbsp;";
                }
    ?>
                    ) Permit
                </p>
                <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) Other</p>

                <p>Thank you for your attention </p>

                <p style="margin-left:5cm; line-height:0.4em;">Sincerely</p>
                <p style="margin-left:5cm; line-height:0.4em;">Bogor, <?= $newDate; ?></p>
                <br>
                <br>
                <br>
                <p style="margin-left:5cm;">(Head Deputy of the Student’s Welfare)</p>
                <br>
                <h3><p class="arab" align="center">وَعَلَيْكُمُ السَّلاَمُ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ</p></h3>
            </page>

        </div>
        <?php
    }
    ?>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
                function print() {
            var contents = $("#dvContents").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({"position": "absolute", "top": "-1000000px"});
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write('<link href="assest/style.css" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        }
        );
    </script>
</body>
</html>
