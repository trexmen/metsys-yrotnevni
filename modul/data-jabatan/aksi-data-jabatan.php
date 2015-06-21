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

      if ($module=='data-jabatan' AND $act=='input'){
          mysql_query("INSERT INTO jabatan(id_jabatan,nama_jabatan) 
                       VALUES(NULL,'$_POST[nama_jabatan]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-jabatan' AND $act=='update'){
          mysql_query("UPDATE jabatan SET nama_jabatan  = '$_POST[nama_jabatan]'   
                                   WHERE id_jabatan = '$_POST[id_jabatan]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
