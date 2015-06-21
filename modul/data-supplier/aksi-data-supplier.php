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

      if ($module=='data-supplier' AND $act=='hapus'){
          mysql_query("DELETE FROM supplier WHERE id_supplier='$_GET[id]'");  
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='data-supplier' AND $act=='input'){
          mysql_query("INSERT INTO supplier(id_supplier,nama_supplier,alamat,telepon) 
                       VALUES('$_POST[id_supplier]','$_POST[nama_supplier]','$_POST[alamat]','$_POST[telepon]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-supplier' AND $act=='update'){
          mysql_query("UPDATE supplier SET nama_supplier  = '$_POST[nama_supplier]',
                                         alamat = '$_POST[alamat]', 
                                         telepon = '$_POST[telepon]'   
                                   WHERE id_supplier = '$_POST[id]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
