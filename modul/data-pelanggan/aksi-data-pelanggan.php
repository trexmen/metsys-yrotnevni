<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
      echo "<link href='style.css' rel='stylesheet' type='text/css'>
      <center>Untuk mengakses modul, Anda harus login <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
      include "../../config/koneksi.php";

      $module=$_GET['module'];
      $act=$_GET['act'];

      if ($module=='data-pelanggan' AND $act=='hapus'){
          mysql_query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");  
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='data-pelanggan' AND $act=='input'){
          mysql_query("INSERT INTO pelanggan(id_pelanggan,nama_pelanggan,alamat,telepon) 
                       VALUES('$_POST[id_pelanggan]','$_POST[nama_pelanggan]','$_POST[alamat]','$_POST[telepon]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-pelanggan' AND $act=='update'){
          mysql_query("UPDATE pelanggan SET nama_pelanggan  = '$_POST[nama_pelanggan]',
                                         alamat = '$_POST[alamat]', 
                                         telepon = '$_POST[telepon]'   
                                   WHERE id_pelanggan = '$_POST[id]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
