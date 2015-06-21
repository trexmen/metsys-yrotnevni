<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
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
                    <div class='col-xs-12'>
                    <input type='button' value='Tambah Data' id='modal-data-barang' act='tambah' class='btn btn-primary pull-left'></div><br/><br/>
                    <div class='box-body table-responsive'>
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>";

                $tampil = mysql_query("SELECT `barang`.`id_barang`       AS `id_barang`,
                                              `barang`.`id_kategori`     AS `id_kategori`,
                                              `kategori`.`nama_kategori` AS `nama_kategori`,
                                              `barang`.`nama_barang`     AS `nama_barang`,
                                              `barang`.`stok`            AS `stok`,
                                              `barang`.`satuan`          AS `satuan`,
                                              `barang`.`harga_beli`      AS `harga_beli`,
                                              `barang`.`harga_jual`      AS `harga_jual`,
                                              `barang`.`foto`            AS `foto`,
                                              `barang`.`safety_stock`    AS `safety_stock`,
                                              `barang`.`order_quantity`  AS `order_quantity`,
                                              `barang`.`lead_time`       AS `lead_time`
                                        FROM (`barang`
                                           JOIN `kategori`
                                             ON ((`barang`.`id_kategori` = `kategori`.`id_kategori`))) ORDER BY `id_barang` ASC");


                while($r=mysql_fetch_array($tampil)){
                  echo"
                                <tr>
                                    <td>$r[id_barang]</td>
                                    <td>$r[nama_barang]</td>
                                    <td>$r[nama_kategori]</td>
                                    <td>$r[stok]</td>
                                    <td>$r[satuan]</td>
                                    <td>$r[harga_beli]</td>
                                    <td>$r[harga_jual]</td>                                    
                                    <td><a href='#' id='modal-data-barang' act='edit' data-id='$r[id_barang]'><i class='fa fa-edit'></i> Edit</a> | 
                                    <a href='#' id='modal-data-barang' act='hapus' data-id='$r[id_barang]'><i class='fa fa-trash-o'></i> Hapus</a></td>
                                </tr>";
                            }
                            
                            echo"
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->";
}
?>
