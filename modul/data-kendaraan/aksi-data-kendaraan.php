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

      if ($module=='data-kendaraan' AND $act=='hapus'){
          mysql_query("DELETE FROM kendaraan WHERE no_kendaraan='$_GET[id]'");  
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='data-kendaraan' AND $act=='input'){
          mysql_query("INSERT INTO kendaraan(no_kendaraan,merek,tahun) 
                       VALUES('$_POST[no_kendaraan]','$_POST[merek]','$_POST[tahun]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-kendaraan' AND $act=='update'){
          mysql_query("UPDATE kendaraan SET merek  = '$_POST[merek]',
                                         tahun = '$_POST[tahun]'   
                                   WHERE no_kendaraan = '$_POST[id]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
