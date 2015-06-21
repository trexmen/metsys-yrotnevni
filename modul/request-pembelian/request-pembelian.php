<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
                  
        $nota=$_GET['id'];
        $query=mysql_query("SELECT penjualan.id_penjualan,detail_penjualan.id_barang,barang.nama_barang,
                           detail_penjualan.harga_jual,detail_penjualan.jumlah,detail_penjualan.subtotal
                           FROM detail_penjualan,penjualan,barang
                           WHERE penjualan.id_penjualan=detail_penjualan.id_penjualan AND barang.id_barang=detail_penjualan.id_barang
                           AND detail_penjualan.id_penjualan='$nota'");
        $i=mysql_fetch_array(mysql_query("SELECT * FROM vpenjualan WHERE id_penjualan='$nota'"));

        $tgl_pengajuan= format_tanggal_lengkap(date('Y-m-d'));
        $minggu= date('W');
        //untuk autonumber di nota
        $auto=mysql_query("SELECT CONCAT('FJ-',DATE_FORMAT(NOW(),'%y%m'),'-',LPAD(COUNT(id_penjualan)+1,4,'0')) AS 'id_penjualan' FROM penjualan");
        $no=mysql_fetch_array($auto);
        $id_penjualan=$no['id_penjualan'];
        $data=mysql_query("SELECT * FROM supplier");
        
        echo"


        <!-- Main content -->
            <section class='content'>
                <div class='row'>
                    <div class='col-xs-12'>                 

                        <div class='box box-primary' >
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
                            <input type='hidden' id='pcs_id_karyawan' value='5'>
                            <input type='hidden' id='pcs_minggu' value='$minggu'> 

                            </div><!-- /.box-header -->
                            <div class='col-xs-12'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label for='id_pembelian'>No. Purchase Order</label>
                                        <input type='text' class='form-control' id='pcs_id_pembelian' name='id_pembelian' value='$id_penjualan' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='nama_supplier'>Nama Supplier</label>";
                                        echo"<select id='pcs_id_supplier' class='form-control' required><option value=''>--Pilih Supplier--</option>";
                                        while($r=mysql_fetch_array($data)){
                                            echo "<option value='$r[id_supplier]'>$r[nama_supplier]</option>";
                                        }
                                        echo"</select>
                                    </div>                                            
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label for='tgl_pengajuan'>Tanggal Pengajuan</label>
                                        <input type='text' class='form-control' id='pcs_tgl_pengajuan' name='tgl_pengajuan' value='$tgl_pengajuan' placeholder='Tanggal Pemesanan' disabled>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xs-12'>
                                <!--
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='pcs_nama_barang' name='nama_barang' placeholder='Nama Barang' disabled>
                                    </div>
                                </div>-->
                                <legend></legend>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <select class='form-control' id='pcs_id_barang' required></select>
                                        <input type='hidden' id='pcs_nama_barang' placeholder='Nama Barang' readonly>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='pcs_harga_beli' name='harga_beli' placeholder='Harga' disabled>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='pcs_stok' name='stok' placeholder='Stok' disabled>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='pcs_jumlah' name='jumlah' placeholder='Jumlah'>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <button class='btn btn-primary' id='pcs_tambah' class='btn'>Tambah</button>
                                    </div>
                                </div>                                
                            
                                <span id='pcs_status'></span>

                                
                            </div>
                            <div class='col-xs-12'>                                       
                                <div class='box-body table-responsive'>
                                    <!-- link ke file PK.PHP -->
                                    <table id='pcs_barang' class='table table-bordered table-striped'></table>                                    
                                </div><!-- /.box-body -->                                
                            </div>
                            <div class='box-footer'>
                                    <a class='btn btn-warning' onclick=self.history.back()>Kembali</a>  <a class='btn btn-success' id='pcs_proses'>Simpan dan Cetak</a>
                                </div>
                                
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->";
}
?>
