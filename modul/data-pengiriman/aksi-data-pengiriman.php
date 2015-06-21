<?php
    include "../../config/koneksi.php";
    $modul=$_GET['module'];
    $act=$_GET['act'];

    // Hapus karyawan
    if ($modul=='data-pengiriman' AND $act=='delete'){

        mysql_query("UPDATE penjualan SET id_pengiriman=NULL WHERE id_penjualan='$_GET[id]'");
        header('location:../../media.php?module=data-pengiriman&act=detail&id='.$_GET['sj']);
    }

    //Tambah
    if ($modul=='data-pengiriman' AND $act=='tambah'){

         mysql_query("UPDATE penjualan SET id_pengiriman='$_GET[sj]' WHERE id_penjualan='$_GET[id]'");
        header('location:../../media.php?module='.$modul.'&act=detail&id='.$_GET['sj']);
    }

    elseif ($modul=='data-pengiriman' AND $act=='input')
    {
        mysql_query("INSERT INTO `pengiriman`(`id_pengiriman`,
                                            `no_kendaraan`,
                                            `id_driver`,
                                            `tgl_pengiriman`) 
                                      VALUES ('$_POST[id_pengiriman]',
                                            '$_POST[no_kendaraan]',
                                            '$_POST[id_driver]',
                                            NOW())");
              
        //echo"$_POST[id_pengiriman] $_POST[no_kendaraan] $_POST[id_driver] $_POST[tgl_pengiriman]";
        header('location:../../media.php?module='.$modul.'&act=detail&id='.$_POST['id_pengiriman']);
    }
?>
