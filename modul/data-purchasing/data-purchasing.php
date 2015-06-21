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
                                                    <th>No. Purchase Order</th>
                                                    <th>Supplier</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Tanggal Pemesanan</th>
                                                    <th>No. Faktur</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                                $tampil = mysql_query("SELECT
                                                      `purchasing`.`id_purchasing`  AS `id_purchasing`,
                                                      `purchasing`.`id_karyawan`    AS `id_karyawan`,
                                                      `karyawan`.`nama_karyawan`    AS `nama_karyawan`,
                                                      `purchasing`.`id_supplier`    AS `id_supplier`,
                                                      `supplier`.`nama_supplier`    AS `nama_supplier`,
                                                      `purchasing`.`minggu`         AS `minggu`,
                                                      `purchasing`.`tgl_pengajuan`  AS `tgl_pengajuan`,
                                                      `purchasing`.`tgl_pemesanan`  AS `tgl_pemesanan`,
                                                      `purchasing`.`tgl_penerimaan` AS `tgl_penerimaan`,
                                                      `purchasing`.`no_faktur`      AS `no_faktur`,
                                                      `purchasing`.`catatan`        AS `catatan`,
                                                      `purchasing`.`status`         AS `status`,
                                                      `purchasing`.`total`          AS `total`
                                                    FROM `purchasing` JOIN `supplier` USING (`id_supplier`)
                                                              JOIN `karyawan` USING (`id_karyawan`) 
                                                    ORDER BY id_purchasing DESC");

                                            while($r=mysql_fetch_array($tampil)){
                                            $tglPengajuan=format_tanggal_lengkap($r['tgl_pengajuan']);
                                            if($r['status']=='Y'){$status='readed.png';}else{$status='unread.png';}
                                            if($r['tgl_pemesanan']==''){$tglPemesanan='Menunggu konfirmasi';}else{$tglPemesanan=format_tanggal_lengkap($r['tgl_pemesanan']);}
                                                echo"
                                                <tr>
                                                    <td>$r[id_purchasing]</td>
                                                    <td>$r[nama_supplier]</td>
                                                    <td>$tglPengajuan</td>
                                                    <td>$tglPemesanan</td>
                                                    <td>$r[no_faktur]</td>
                                                    <td><img src='img/$status' width='25px'></td>                                
                                                    <td><a href='?module=data-purchasing&act=detail&id=$r[id_purchasing]'><i class='fa fa-search'></i> Detail</a></td>
                                                </tr>";
                                                //<a href='#' id='modal-data-purchasing' act='edit' data-id='$r[id_purchasing]'>
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
                    $po=$_GET['id'];
                    $query=mysql_query("SELECT purchasing.`id_purchasing`,
                                                detail_purchasing.`id_barang`,
                                                barang.`nama_barang`,
                                                detail_purchasing.`harga_beli`,
                                                detail_purchasing.`jumlah`,
                                                detail_purchasing.`subtotal`
                                        FROM detail_purchasing JOIN purchasing USING(id_purchasing) JOIN barang USING (id_barang)
                                        WHERE id_purchasing='$po'");
                    $i=mysql_fetch_array(mysql_query("SELECT
                                                      `purchasing`.`id_purchasing`  AS `id_purchasing`,
                                                      `purchasing`.`id_karyawan`    AS `id_karyawan`,
                                                      `karyawan`.`nama_karyawan`    AS `nama_karyawan`,
                                                      `purchasing`.`id_supplier`    AS `id_supplier`,
                                                      `supplier`.`nama_supplier`    AS `nama_supplier`,
                                                      `purchasing`.`minggu`         AS `minggu`,
                                                      `purchasing`.`tgl_pengajuan`  AS `tgl_pengajuan`,
                                                      `purchasing`.`tgl_pemesanan`  AS `tgl_pemesanan`,
                                                      `purchasing`.`tgl_penerimaan` AS `tgl_penerimaan`,
                                                      `purchasing`.`no_faktur`      AS `no_faktur`,
                                                      `purchasing`.`catatan`        AS `catatan`,
                                                      `purchasing`.`status`         AS `status`,
                                                      `purchasing`.`total`          AS `total`
                                                    FROM `purchasing` JOIN `supplier` USING (`id_supplier`)
                                                              JOIN `karyawan` USING (`id_karyawan`)
                                                    WHERE id_purchasing='$po'"));
                    $tglPengajuan= format_tanggal_lengkap($i['tgl_pengajuan']);
                    $tglPemesanan=format_tanggal_lengkap($i['tgl_pemesanan']);
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
                                                <label for='id_purchasing'>No.Purchase Order</label>
                                                <input type='text' class='form-control' id='id_purchasing' name='id_purchasing' value='$i[id_purchasing]' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama_supplier'>Nama Supplier</label>
                                                <input type='text' class='form-control' id='nama_pelanggan' name='nama_pelanggan' value='$i[nama_supplier]' disabled>
                                            </div>                                            
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label for='tgl_pengajuan'>Tanggal Pengajuan</label>
                                                <input type='text' class='form-control' id='tgl_pengajuan' name='tgl_pengajuan' value='$tglPengajuan' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='tgl_pemesanan'>Tanggal Pemesanan</label>
                                                <input type='text' class='form-control' id='tgl_pemesanan' name='tgl_pemesanan' value='$tglPemesanan' disabled>
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
                                                        <td>".format_rupiah($r[harga_beli])."</td>
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
                                            <a class='btn btn-primary' onclick=self.history.back()>Kembali</a>  <a class='btn btn-primary' target='_blank' onclick=\"window.location.href='export/cetak_nota_purchasing.php?id=$i[id_purchasing]';\">Cetak</a>
                                        </div>
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </section><!-- /.content -->";
                    break;
        }

}
?>
