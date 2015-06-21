<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
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
                                    <div class='box-body table-responsive'>
                                        <table id='example1' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>No. Nota</th>
                                                    <th>Pelanggan</th>
                                                    <th>Tanggal Pemesanan</th>
                                                    <th>Tanggal Pengiriman</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                                $tampil = mysql_query(" SELECT `id_penjualan`,`id_karyawan`,`nama_karyawan`,`id_pelanggan`,`nama_pelanggan`,pelanggan.`alamat`,`minggu`,`tgl_pemesanan`,`tgl_pengiriman`,`catatan`,`status`,`total`
                                                        FROM `penjualan` JOIN `pelanggan` USING (`id_pelanggan`)
                                                                 JOIN `karyawan` USING (`id_karyawan`)
                                                        ORDER BY id_penjualan DESC");

                                            while($r=mysql_fetch_array($tampil)){
                                            $tglPesan=format_tanggal_lengkap($r['tgl_pemesanan']);
                                            if($r['status']=='Y'){$status='readed.png';}else{$status='unread.png';}
                                            if($r['tgl_pengiriman']==''){$tglKirim='Menunggu konfirmasi';}else{$tglKirim=format_tanggal_lengkap($r['tgl_pengiriman']);}
                                                echo"
                                                <tr>
                                                    <td>$r[id_penjualan]</td>
                                                    <td>$r[nama_pelanggan]</td>
                                                    <td>$tglPesan</td>
                                                    <td>$tglKirim</td>
                                                    <td><img src='img/$status' width='25px'></td>
                                                    <td><a href='?module=print-data&id=$r[id_penjualan]'><i class='fa fa-search'></i> Detail</a></td>                                
                                                    <!--<td><a href='?module=data-penjualan&act=detail&id=$r[id_penjualan]'><i class='fa fa-search'></i> Detail</a></td>-->                                                    
                                                </tr>";
                                                //<a href='#' id='modal-data-penjualan' act='edit' data-id='$r[id_penjualan]'>
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
                    $nota=$_GET['id'];
                    $query=mysql_query("select penjualan.id_penjualan,detail_penjualan.id_barang,barang.nama_barang,
                                       detail_penjualan.harga_jual,detail_penjualan.jumlah,detail_penjualan.subtotal
                                       from detail_penjualan,penjualan,barang
                                       where penjualan.id_penjualan=detail_penjualan.id_penjualan and barang.id_barang=detail_penjualan.id_barang
                                       and detail_penjualan.id_penjualan='$nota'");
                    $i=mysql_fetch_array(mysql_query("select * from vpenjualan where id_penjualan='$nota'"));
                    $tglTrans= format_tanggal_lengkap($i['tgl_pemesanan']);
                    $tglKirim=format_tanggal_lengkap($i['tgl_pengiriman']);
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
                                                <label for='kodeLK'>No Nota</label>
                                                <input type='text' class='form-control' id='id_penjualan' name='id_penjualan' value='$i[id_penjualan]' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='kodeLK'>Nama Pelanggan</label>
                                                <input type='text' class='form-control' id='nama_pelanggan' name='nama_pelanggan' value='$i[nama_pelanggan]' disabled>
                                            </div>                                            
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label for='nama'>Tanggal Pemesanan</label>
                                                <input type='text' class='form-control' id='tgl_pemesanan' name='tgl_pemesanan' value='$tglTrans' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama'>Tanggal Pengiriman</label>
                                                <input type='text' class='form-control' id='tgl_pengiriman' name='tgl_pengiriman' value='$tglKirim' disabled>
                                            </div>
                                        </div>                                        
                                        <div class='box-body table-responsive'>
                                            <table id='example3' class='table table-bordered table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th>ID Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";

                                                while($r=mysql_fetch_array($query)){
                                                echo"
                                                    <tr>
                                                        <td>$r[id_barang]</td>
                                                        <td>$r[nama_barang]</td>
                                                        <td>".format_rupiah($r[harga_jual])."</td>
                                                        <td>$r[jumlah]</td>
                                                        <td>".format_rupiah($r[subtotal])."</td>
                                                    </tr>";
                                                }
                                                
                                                echo"
                                                </tbody>
                                                <tfooter>
                                                    <tr>
                                                        <th colspan='4'>Total</th>
                                                        <th>".format_rupiah($i[total])."</th>
                                                    </tr>
                                                </tfooter>
                                            </table>
                                        </div><!-- /.box-body -->
                                        <div class='box-footer'>
                                            <a class='btn btn-primary' onclick=self.history.back()>Kembali</a>  <a class='btn btn-primary' target='_blank' onclick=\"window.location.href='export/cetak_nota_penjualan.php?id=$i[id_penjualan]';\">Cetak</a>
                                        </div>
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </section><!-- /.content -->";
                    break;
        }

}
?>
