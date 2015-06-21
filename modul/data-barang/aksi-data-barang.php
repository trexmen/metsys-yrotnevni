<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
      echo "<link href='style.css' rel='stylesheet' type='text/css'>
      <center>Untuk mengakses modul, Anda harus login <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
      include "../../config/koneksi.php";
      include "../../config/fungsi_thumb.php";

      $module=$_GET['module'];
      $act=$_GET['act'];

      $lokasi_file    = $_FILES['fupload']['tmp_name'];
      $tipe_file      = $_FILES['fupload']['type'];
      $nama_file      = $_FILES['fupload']['name'];
      $acak           = rand(000000,999999);
      $nama_file_unik = $acak.$nama_file; 

      
      if ($module=='data-barang' AND $act=='hapus'){
          $data=mysql_fetch_array(mysql_query("SELECT foto FROM barang WHERE id_barang='$_GET[id]'"));
          /*cek*/
          $cekDataPembelian=mysql_num_rows(mysql_query("SELECT * FROM detail_pembelian WHERE id_barang='$_GET[id]'"));
          $cekDataPenjualan=mysql_num_rows(mysql_query("SELECT * FROM detail_penjualan WHERE id_barang='$_GET[id]'"));
          if(($cekDataPembelian==0)&&($cekDataPenjualan==0))
          {
                if (($foto['foto']!='')||($foto['foto']!='avatar.png')){
                    mysql_query("DELETE FROM barang WHERE id_barang='$_GET[id]'");
                    unlink("../../upload_foto/$data[foto]");
                    unlink("../../upload_foto/medium_$data[foto]");   
                    unlink("../../upload_foto/small_$data[foto]");
                }
                else{
                    mysql_query("DELETE FROM barang WHERE id_barang='$_GET[id]'");  
                }   
                header('location:../../media.php?module='.$module.'&stat=deleted');
          }
          else
          {
              header('location:../../home.php?module='.$modul.'&stat=deleted');
          }
      }
      elseif ($module=='data-barang' AND $act=='input'){
          if (empty($lokasi_file)){
                mysql_query("INSERT INTO `barang`(`id_barang`,
                                                      `id_kategori`,                                                      
                                                      `nama_barang`,
                                                      `stok`,
                                                      `satuan`,
                                                      `harga_beli`,
                                                      `harga_jual`) 
                                                VALUES ( NULL,
                                                      '$_POST[id_kategori]',                                                      
                                                      '$_POST[nama_barang]',
                                                      '$_POST[stok]',
                                                      '$_POST[satuan]',
                                                      '$_POST[harga_beli]',
                                                      '$_POST[harga_jual]')");
                header('location:../../media.php?module='.$module.'&stat=succeed');
          }
          else{
                if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpg"){
                      header('location:../../media.php?module='.$module.'&stat=failed');
                }
                else{
                      UploadImage($nama_file_unik);
                      mysql_query("INSERT INTO `barang`(`id_barang`,
                                                      `id_kategori`,
                                                      `nama_barang`,
                                                      `stok`,
                                                      `satuan`,                                                      
                                                      `harga_beli`,
                                                      `harga_jual`,
                                                      `foto`) 
                                                VALUES ( NULL,
                                                      '$_POST[id_kategori]',
                                                      '$_POST[nama_barang]',
                                                      '$_POST[stok]',
                                                      '$_POST[satuan]',
                                                      '$_POST[harga_beli]',
                                                      '$_POST[harga_jual]',                                                        
                                                      '$nama_file_unik')");
                      header('location:../../media.php?module='.$module.'&stat=succeed');                      
                }
          }
                        
      }
      elseif ($module=='data-barang' AND $act=='update'){              

            if (empty($lokasi_file)){
                  mysql_query("UPDATE `barang` SET  `nama_barang`='$_POST[nama_barang]',
                                              `stok`='$_POST[stok]',
                                              `harga_beli`='$_POST[harga_beli]',
                                              `harga_jual`='$_POST[harga_jual]',
                                              `satuan`='$_POST[satuan]',
                                              `id_kategori`='$_POST[id_kategori]' 
                                        WHERE `id_barang`='$_POST[id_barang]'");
                  header('location:../../media.php?module='.$module.'&stat=updated');
            }
            else{
                  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpg"){
                        header('location:../../media.php?module='.$module.'&stat=failed');
                  }
                  else{
                        $foto=mysql_fetch_array(mysql_query("SELECT * FROM barang WHERE id_barang='$_POST[id_barang]'"));
                        if (($foto['foto']!='')&&($foto['foto']!='avatar.png')){
                            unlink("../../upload_foto/$foto[foto]");
                            unlink("../../upload_foto/medium_$foto[foto]");   
                            unlink("../../upload_foto/small_$foto[foto]");
                        }

                        UploadImage($nama_file_unik);
                        mysql_query("UPDATE `barang` SET  `nama_barang`='$_POST[nama_barang]',
                                              `stok`='$_POST[stok]',
                                              `harga_beli`='$_POST[harga_beli]',
                                              `harga_jual`='$_POST[harga_jual]',
                                              `foto`='$nama_file_unik',
                                              `satuan`='$_POST[satuan]',
                                              `id_kategori`='$_POST[id_kategori]' 
                                        WHERE `id_barang`='$_POST[id_barang]'");
                        header('location:../../media.php?module='.$module.'&stat=updated');
                  }
            }

      }

}
?>
