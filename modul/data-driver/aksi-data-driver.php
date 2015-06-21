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

      if ($module=='data-driver' AND $act=='hapus'){
          mysql_query("DELETE FROM driver WHERE id_driver='$_GET[id]'");  
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='data-driver' AND $act=='input'){
          mysql_query("INSERT INTO driver(id_driver,nama_driver,alamat,telepon) 
                       VALUES('$_POST[id_driver]','$_POST[nama_driver]','$_POST[alamat]','$_POST[telepon]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-driver' AND $act=='update'){
          mysql_query("UPDATE driver SET nama_driver  = '$_POST[nama_driver]',
                                         alamat = '$_POST[alamat]', 
                                         telepon = '$_POST[telepon]'   
                                   WHERE id_driver = '$_POST[id]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
