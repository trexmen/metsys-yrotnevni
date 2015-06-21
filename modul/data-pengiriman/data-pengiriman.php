<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
    $aksi="modul/data-pengiriman/aksi-data-pengiriman.php";
    switch($_GET['act']){

            default:
                    echo"
                    <!-- Main content -->
                    <section class='content'>
                        <div class='row'>
                            <div class='col-xs-12'>                 

                                <div class='box'>
                                    <div class='box-header'>
                                        <h3 class='box-title'></h3>";
                                echo"

                                    </div><!-- /.box-header -->
                                    <div class='col-xs-12'>
                                    </div>
                                    <div class='col-xs-12'>
                                    <a href='?module=data-pengiriman&act=tambah' class='btn btn-primary pull-left'>Buat Pengiriman Baru</a><br/><br/>
                                    <div class='box-body table-responsive'>
                                        <table id='example1' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <td>Surat Jalan</th>
                                                    <td>Tanggal Pengiriman</th>
                                                    <td>Nomor Kendaraan</th>
                                                    <td>Nama Driver</th>
                                                    <td>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                                $tampil = mysql_query("SELECT
                                                          `pengiriman`.`id_pengiriman`  AS `id_pengiriman`,
                                                          `pengiriman`.`no_kendaraan`   AS `no_kendaraan`,
                                                          `driver`.`nama_driver`        AS `nama_driver`,
                                                          `pengiriman`.`tgl_pengiriman` AS `tgl_pengiriman`
                                                        FROM `pengiriman` JOIN `kendaraan` USING(`no_kendaraan`)
                                                                  JOIN `driver` USING(`id_driver`) 
                                                        ORDER BY tgl_pengiriman DESC");

                                            while($r=mysql_fetch_array($tampil)){
                                            $tgl_pengiriman=format_tanggal_lengkap($r['tgl_pengiriman']);
                                                echo"
                                                <tr>
                                                    <td>$r[id_pengiriman]</td>
                                                    <td>$tgl_pengiriman</td>
                                                    <td>$r[no_kendaraan]</td>
                                                    <td>$r[nama_driver]</td>                               
                                                    <td><a href='?module=data-pengiriman&act=detail&id=$r[id_pengiriman]'><i class='fa fa-search'></i> Detail</a></td>                                        
                                                </tr>";
                                                //<a href='#' id='modal-data-pengiriman' act='edit' data-id='$r[id_penjualan]'>
                                            }
                                            
                                            echo"
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </section><!-- /.content -->";
                    break;

                case "detail":
                    $suratJalan=$_GET['id'];
                        $query=mysql_query("SELECT `id_penjualan`, `tgl_pemesanan`,pengiriman.`tgl_pengiriman`,`nama_pelanggan`,`alamat` FROM penjualan JOIN pengiriman USING(id_pengiriman) JOIN pelanggan USING(id_pelanggan) WHERE id_pengiriman='$suratJalan'");
                        $r=mysql_fetch_array(mysql_query("SELECT
                                                              `pengiriman`.`id_pengiriman`  AS `id_pengiriman`,
                                                              `pengiriman`.`no_kendaraan`   AS `no_kendaraan`,
                                                              `driver`.`nama_driver`        AS `nama_driver`,
                                                              `pengiriman`.`tgl_pengiriman` AS `tgl_pengiriman`
                                                            FROM `pengiriman` JOIN `kendaraan` USING(`no_kendaraan`)
                                                                      JOIN `driver` USING(`id_driver`) 
                                                            WHERE id_pengiriman='$suratJalan'"));
                        $tgl_pengiriman=format_tanggal_lengkap($r['tgl_pengiriman']); 
                    echo"

                    <!-- Main content -->
                        <section class='content'>
                            <div class='row'>
                                <div class='col-xs-12'>                 

                                    <div class='box'>
                                        <div class='box-header'>
                                            <h3 class='box-title'></h3>";

                                    switch($_GET['stat']){
                                        case "succeed": echo"
                                                    <div class='alert alert-success alert-dismissable'>
                                                        <i class='fa fa-check'></i>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <b>Alert!</b> Data baru berhasil disimpan.
                                                    </div>";
                                                    break;
                                        case "updated": echo"
                                                    <div class='alert alert-info alert-dismissable'>
                                                        <i class='fa fa-info'></i>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <b>Alert!</b> Data berhasil diupdate.
                                                    </div>";
                                                    break;
                                        case "deleted": echo"
                                                    <div class='alert alert-warning alert-dismissable'>
                                                        <i class='fa fa-warning'></i>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <b>Alert!</b> Data baru berhasil dihapus.
                                                    </div>";
                                                    break;
                                        case "failed": echo"
                                                    <div class='alert alert-danger alert-dismissable'>
                                                        <i class='fa fa-ban'></i>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <b>Alert!</b> Data baru gagal disimpan.
                                                    </div>";
                                                    break;                      
                                        }
                                    echo"

                                        </div><!-- /.box-header -->
                                    
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label for='id_pengiriman'>No.Surat Jalan</label>
                                                <input type='text' class='form-control' id='id_pengiriman' name='id_pengiriman' value='$r[id_pengiriman]' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='no_kendaraan'>No. Kendaraan</label>
                                                <input type='text' class='form-control' id='no_kendaraan' name='no_kendaraan' value='$r[no_kendaraan]' disabled>
                                            </div>                                            
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label for='tgl_pengiriman'>Tanggal Pengiriman</label>
                                                <input type='text' class='form-control' id='tgl_pengiriman' name='tgl_pengiriman' value='$tgl_pengiriman' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama_driver'>Nama Driver</label>
                                                <input type='text' class='form-control' id='nama_driver' name='nama_driver' value='$r[nama_driver]' disabled>
                                            </div>
                                        </div>                                        
                                        <div class='box-body table-responsive'>
                                            <table id='example3' class='table table-bordered table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th>Id Penjualan</th>
                                                        <th>Tanggal Pemesanan</th>
                                                        <th>Nama Pelaggan</th>
                                                        <th>Alamat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";

                                                while($r=mysql_fetch_array($query)){
                                                    $tglPesan= format_tanggal_lengkap($r['tgl_pemesanan']);
                                                echo"
                                                    <tr>
                                                        <td>$r[id_penjualan]</td>
                                                        <td>$tglPesan</td>
                                                        <td>$r[nama_pelanggan]</td>
                                                        <td>$r[alamat]</td>
                                                        <td><a href='?module=print-data&id=$r[id_penjualan]'><i class='fa fa-search'></i> Detail</a> | <a href='$aksi?module=data-pengiriman&act=delete&sj=$_GET[id]&id=$r[id_penjualan]'><i class='fa fa-trash-o'></i> Hapus</a></td>
                                                    </tr>";
                                                }
                                                
                                                echo"
                                                </tbody>                                                
                                            </table>
                                        </div><!-- /.box-body -->
                                        <div class='box-footer'>
                                            <a class='btn btn-primary' onclick=self.history.back()>Kembali</a>  <a class='btn btn-primary' target='_blank' onclick=\"window.location.href='export/cetak_nota_penjualan.php?id=$i[id_penjualan]';\">Cetak</a>
                                        </div>

                                                </table><hr/><center>PEMESANAN BARANG YANG BELUM DIKIRIM KE PELANGGAN</center><hr/>";

                                                $bkirim=mysql_query("SELECT * FROM penjualan JOIN pelanggan USING(id_pelanggan) WHERE id_pengiriman IS NULL");
                                                echo"<table class='table table-striped table-bordered table-hover'>
                                                    <thead>
                                                            <tr>
                                                                <td>Id Penjualan</td>
                                                                <td>Tanggal Pemesanan</td>
                                                                <td>Nama Pelanggan</td>
                                                                <td>Alamat</td>
                                                                <td>Aksi</td>
                                                            </tr>
                                                        </thead>";
                                                    while ($b=mysql_fetch_array($bkirim)){
                                                        echo"<tr>
                                                                <td>$b[id_penjualan]</td>
                                                                <td>$b[tgl_pemesanan]</td>
                                                                <td>$b[nama_pelanggan]</td>
                                                                <td>$b[alamat]</td>
                                                                <td><a href='$aksi?module=data-pengiriman&act=tambah&sj=$_GET[id]&id=$b[id_penjualan]'><i class='fa fa-plus-circle'></i> Tambahkan</a> | <a href='?module=print-data&id=$r[id_penjualan]'><i class='fa fa-search'></i> Detail</a></td>
                                                            </tr>";
                                                        }
                                                    echo "</table>


                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </section><!-- /.content -->";
                    break;

            case "tambah":
                        $sj=mysql_fetch_array(mysql_query("SELECT CONCAT('SJ-',DATE_FORMAT(NOW(),'%y%m'),'-',LPAD(COUNT(id_pengiriman)+1,4,'0')) AS 'id_pengiriman' 
                                        FROM pengiriman
                                        WHERE DATE_FORMAT(tgl_pengiriman,'%y%m')=DATE_FORMAT(NOW(),'%y%m')"));
                        $suratJalan=$sj[id_pengiriman];
                        $query=mysql_query("SELECT `id_penjualan`, `tgl_pemesanan`,pengiriman.`tgl_pengiriman`,`nama_pelanggan`,`alamat` FROM penjualan JOIN pengiriman USING(id_pengiriman) JOIN pelanggan USING(id_pelanggan) WHERE id_pengiriman='$suratJalan'");
                        $nomor=mysql_fetch_array(mysql_query("select * from vpengiriman where id_pengiriman='$suratJalan'"));
                        $tglKirim= format_tanggal_lengkap(date('Y-m-d'));                        
                        echo"<form method=POST action='$aksi?module=data-pengiriman&act=input'>
                            <table class='table-detail-transaksi'>
                            <tr>
                                <td>No.Surat Jalan</td>
                                <td>:</td>
                                <td colspan='2'><input type='text' name='id_pengiriman' value='$suratJalan'></td>
                                <td></td>
                                <td>No. Kendaraan</td>
                                <td>:</td>
                                <td><select name='no_kendaraan' required><option value='' selected>- Pilih Kendaraan -</option>";
                                                $tampil=mysql_query("SELECT * FROM kendaraan ORDER BY no_kendaraan");
                                                while($r=mysql_fetch_array($tampil))
                                                {
                                                  echo "<option value=$r[no_kendaraan]>$r[no_kendaraan]</option>";
                                                }
                                                echo"</select></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengiriman</td>
                                <td>:</td>
                                <td colspan='2'><input type='text' name='tgl_pengiriman' value='$tglKirim'></td>
                                <td></td>
                                <td>Nama Driver</td>
                                <td>:</td>
                                <td><select name='id_driver' required><option value='' selected>- Pilih Driver -</option>";
                                                $tampilDriver=mysql_query("SELECT * FROM driver ORDER BY nama_driver");
                                                while($rd=mysql_fetch_array($tampilDriver))
                                                {
                                                  echo "<option value=$rd[id_driver]>$rd[nama_driver]</option>";
                                                }
                                                echo"</select></td>
                            </tr>
                            </table>";

                        echo "<table class='table table-striped table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <td>Id Penjualan</td>
                                        <td>Tanggal Pemesanan</td>
                                        <td>Nama Pelaggan</td>
                                        <td>Alamat</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>";
                                while($r=mysql_fetch_array($query)){
                                    $tglPesan= format_tanggal_lengkap($r['tgl_pemesanan']);
                                    echo "<tr>
                                            <td>$r[id_penjualan]</td>
                                            <td>$tglPesan</td>
                                            <td>$r[nama_pelanggan]</td>
                                            <td>$r[alamat]</td>
                                            <td><a href='home.php?modul=cek_permintaan&act=detail&nota=$r[id_penjualan]'>Detail</a> | <a href='$aksi?modul=pengiriman&act=delete&sj=$_GET[id]&id=$r[id_penjualan]'>Hapus</a></td>
                                        </tr>";
                                }
                                echo "
                                    <tr>
                                        <td colspan='5'></td>
                                    </tr>
                                    </table>
                                    <input type=submit value=Simpan>
                                    </form>";
                        break;
        }

}
?>
