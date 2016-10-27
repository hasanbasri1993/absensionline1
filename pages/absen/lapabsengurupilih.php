            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Laporan Absensi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Laporan Absensi Guru
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              <form role="form" action="http://absen.daarululuumlido.com/pages/home.php?cat=absen&page=lapabsenguru" name="pilih" method="post">
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
                                <div class="form-group">
                                  <button  name="tampilkan" type="submit" class="form-control btn btn-primary">Submit</button>
                                </div>
                              </form>
                                  <script>
                                  $(document).ready(function() {
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
