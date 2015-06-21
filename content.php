<?php
include "config/koneksi.php";
include "config/format-tanggal.php";
include "config/format-rupiah.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/dashboard/dashboard.php";
  }
  elseif ($_SESSION['leveluser']=='user'){
  }
}

// Bagian Manajemen User
elseif ($_GET['module']=='manajemen-user'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/manajemen-user/manajemen-user.php";
  }
}

// Bagian Data Jabatan
elseif ($_GET['module']=='data-jabatan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-jabatan/data-jabatan.php";
  }
}

// Bagian Update Profil
elseif ($_GET['module']=='update-profil'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/update-profil/update-profil.php";
  }
}

// Bagian Data Barang
elseif ($_GET['module']=='data-barang'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-barang/data-barang.php";
  }
}

// Bagian Data Kategori
elseif ($_GET['module']=='data-kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-kategori/data-kategori.php";
  }
}

// Bagian Data Satuan
elseif ($_GET['module']=='data-satuan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-satuan/data-satuan.php";
  }
}

// Bagian Data Supplier
elseif ($_GET['module']=='data-supplier'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-supplier/data-supplier.php";
  }
}

// Bagian Data Pelanggan
elseif ($_GET['module']=='data-pelanggan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-pelanggan/data-pelanggan.php";
  }
}

// Bagian Data Driver
elseif ($_GET['module']=='data-driver'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-driver/data-driver.php";
  }
}

// Bagian Data Kendaraan
elseif ($_GET['module']=='data-kendaraan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-kendaraan/data-kendaraan.php";
  }
}

// Bagian Data Penjualan
elseif ($_GET['module']=='data-penjualan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-penjualan/data-penjualan.php";
  }
}

// Bagian Transaksi Penjualan
elseif ($_GET['module']=='transaksi-penjualan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/transaksi-penjualan/transaksi-penjualan.php";
  }
}

// Bagian Data Penjualan
elseif ($_GET['module']=='data-pengiriman'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-pengiriman/data-pengiriman.php";
  }
}

// Bagian Transaksi Purchasing
elseif ($_GET['module']=='request-pembelian'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/request-pembelian/request-pembelian.php";
  }
}

// Bagian Data Purchasing
elseif ($_GET['module']=='data-purchasing'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/data-purchasing/data-purchasing.php";
  }
}

// Bagian Print Data
elseif ($_GET['module']=='print-data'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/print-data/print-data.php";
  }
}


// Apabila modul tidak ditemukan
else{
  include "404.php";
}
?>


<!-- jQuery 2.0.2 -->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
    <script src="js/jquery.min.js"></script>
    <!--<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js"></script>-->
    <script src="js/validator/validator.min.js"></script>
    <!--<script src="http://1000hz.github.io/bootstrap-validator/assets/js/application.js"></script>-->
    <script src="js/validator/application.js"></script>



    <!-- Bootstrap -->
    <!--<script src="js/bootstrap.min.js" type="text/javascript"></script> untuk Profil-->
    <!-- DATA TABES SCRIPT -->
    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <!--<script src="js/AdminLTE/app.js" type="text/javascript"></script> untuk Full Screen-->
    <!-- AdminLTE for demo purposes -->
    <!--<script src="js/AdminLTE/demo.js" type="text/javascript"></script> Untuk Tema-->
    <!-- page script -->
    <script type="text/javascript">
        $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>

    <script type="text/javascript">

    $('#password_baru').keyup(function (e) {
           if($('#password_baru').val() != ''){
              $('#ulangi_password').attr('required',true);              
           }
           else{
              $('#ulangi_password').attr('required',false);            
           }
    });

    $('#update_profil').on('submit', function (e) {
          if($('#password_baru').val() != ''){
              $('#ulangi_password').attr('required',true);              
           }
           else{
              $('#ulangi_password').attr('required',false);            
           }

    })
    
    </script>

    <style type="text/css">
        legend {
            padding: 0;
            margin-left: 10px;
            margin-bottom: -9px;
            border: 0;
            color: #999999;
            background-color: #333333;
        }

        /*.the-legend {
            border-style: none;
            border-width: 0;
            font-size: 14px;
            line-height: 20px;
            margin-bottom: 0;
        }
        .the-fieldset {
            border: 2px groove threedface #444;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
                    box-shadow:  0px 0px 0px 0px #000;
        }*/

        /*<form>
            <fieldset class="well the-fieldset">
                <legend class="the-legend">Your legend</legend>
                ... your inputs ...
            </fieldset>
        </form>*/

    </style>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" > <!--data-backdrop="static"-->
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
              </div>
              <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="simpan btn btn-primary">Simpan</button>
              </div> -->
          </div>
      </div>
  </div>

  <script>
        
        $(function(){
            //MODAL LOG OUT 
            $(document).on('click','#modal-sign-out',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = 'Pesan';
                $.post('modal-logout.php',
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);                        
                    }   
                );
            });

            //MODAL DATA SUPPLIER
            $(document).on('click','#modal-data-supplier',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Supplier';
                }
                else if(title=='edit'){
                    title='Edit Data Supplier';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/data-supplier/modal-data-supplier.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA PELANGGAN
            $(document).on('click','#modal-data-pelanggan',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Pelanggan';
                }
                else if(title=='edit'){
                    title='Edit Data Pelanggan';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/data-pelanggan/modal-data-pelanggan.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL  MANAGEMENT USER
            $(document).on('click','#modal-manajemen-user',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah User Baru';
                }
                else if(title=='edit'){
                    title='Edit Data User';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/manajemen-user/modal-manajemen-user.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA JABATAN
            $(document).on('click','#modal-data-jabatan',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Jabatan';
                }
                else if(title=='edit'){
                    title='Edit Data Jabatan';
                }
                $.post('modul/data-jabatan/modal-data-jabatan.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL  UPDATE PROFIL
            $(document).on('click','#modal-update-profil',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = "Edit Data Profil";
                $.post('modul/update-profil/modal-update-profil.php',
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA BARANG
            $(document).on('click','#modal-data-barang',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Barang';
                }
                else if(title=='edit'){
                    title='Edit Data Barang';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/data-barang/modal-data-barang.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA KATEGORI
            $(document).on('click','#modal-data-kategori',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Kategori';
                }
                else if(title=='edit'){
                    title='Edit Data Kategori';
                }
                $.post('modul/data-kategori/modal-data-kategori.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA SATUAN
            $(document).on('click','#modal-data-satuan',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Satuan';
                }
                else if(title=='edit'){
                    title='Edit Data Satuan';
                }
                $.post('modul/data-satuan/modal-data-satuan.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA DRIVER
            $(document).on('click','#modal-data-driver',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Driver';
                }
                else if(title=='edit'){
                    title='Edit Data Driver';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/data-driver/modal-data-driver.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });

            //MODAL DATA KENDARAAN
            $(document).on('click','#modal-data-kendaraan',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                var title = $(this).attr('act');
                if(title=='tambah'){
                    title='Tambah Data Kendaraan';
                }
                else if(title=='edit'){
                    title='Edit Data Kendaraan';
                }
                else if(title='hapus'){
                    title='Pesan';
                }
                $.post('modul/data-kendaraan/modal-data-kendaraan.php',
                    {id:$(this).attr('data-id'),act:$(this).attr('act')},
                    function(html){
                        $(".modal-body").html(html);
                        $(".modal-title").html(title);
                    }   
                );
            });


            function grafikStokBarang()
            {
                //GRAFIK
                $.ajax({
                    url:"modul/dashboard/grafik.php",
                    data:"op=ambildatabarang",
                    cache:false,
                    success:function(jsonData){
                        //alertShow(jsonData);

                        Morris.Bar({
                            element: 'bar2-chart',
                            resize: true,
                            data:JSON.parse(jsonData),
                            xkey: 'nama_barang',
                            ykeys: ['stok'],
                            labels: ['Stok'],
                            hideHover: 'auto',
                            barColors: function (row, series, type) {
                                if (type === 'bar') {
                                  var red = Math.ceil(255 * row.y / this.ymax);
                                  return 'rgb(' + red + ',0,0)';
                                }
                                else {
                                  return '#000';
                                }
                            }
                        });                        
                    }                
                });
            }

            function grafikPenjualan()
            {
                //GRAFIK
                $.ajax({
                    url:"modul/dashboard/grafik.php",
                    data:"op=ambildatapenjualan",
                    cache:false,
                    success:function(jsonData){
                        //alertShow(jsonData);

                        Morris.Area({
                            element: 'revenue2-chart',
                            behaveLikeLine: true,
                            resize: true,
                            data:JSON.parse(jsonData),
                            barColors: ['#f56954','#00a65a'],
                            xkey: 'minggu',
                            ykeys: ['total_penjualan', 'total_pembelian'],
                            labels: ['Penjualan', 'Pembelian'],
                            hideHover: 'auto',
                            parseTime: false
                        });                        
                    }                
                });                
            }

            function presentasePenjualan()
            {
                //GRAFIK
                $.ajax({
                    url:"modul/dashboard/grafik.php",
                    data:"op=presentasePenjualan",
                    cache:false,
                    success:function(jsonData){
                        //alertShow(jsonData);

                        Morris.Donut({
                              element: 'presentasePenjualan-chart',
                              data:JSON.parse(jsonData),
                              formatter: function (x) { return x + "%"}
                            }).on('click', function(i, row){
                              console.log(i, row);
                        });                        
                    }                
                });                
            }

            grafikStokBarang();
            grafikPenjualan();
            presentasePenjualan();




            












        });
    </script>

            <!-- MODUL Javascript -->
        <script src='js/transaksi.js' type='text/javascript'></script>
        <script src='js/jquery.fullscreen-0.4.1.min.js' type="text/javascript"></script>
        <script src='js/fullscreen.js' type='text/javascript'></script>







  

