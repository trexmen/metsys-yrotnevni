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

      if ($module=='data-satuan' AND $act=='input'){
          mysql_query("INSERT INTO satuan(id_satuan,nama_satuan) 
                       VALUES(NULL,'$_POST[nama_satuan]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-satuan' AND $act=='update'){
          mysql_query("UPDATE satuan SET nama_satuan  = '$_POST[nama_satuan]'   
                                   WHERE id_satuan = '$_POST[id_satuan]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
