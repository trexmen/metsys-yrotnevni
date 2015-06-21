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

      if ($module=='data-kategori' AND $act=='input'){
          mysql_query("INSERT INTO kategori(id_kategori,nama_kategori) 
                       VALUES(NULL,'$_POST[nama_kategori]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-kategori' AND $act=='update'){
          mysql_query("UPDATE kategori SET nama_kategori  = '$_POST[nama_kategori]'   
                                   WHERE id_kategori = '$_POST[id_kategori]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
