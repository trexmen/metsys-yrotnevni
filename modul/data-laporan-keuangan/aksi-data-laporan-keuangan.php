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

      if ($module=='data-laporan-keuangan' AND $act=='hapus'){
          mysql_query("DELETE FROM `lk` WHERE kode_lk='$_GET[id]'");  
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='data-laporan-keuangan' AND $act=='input'){
          mysql_query("INSERT INTO `lk`(`kode_lk`,`current_asset`,`total_asset`,`current_liabilities`,`total_liabilities`,`gross_profit`,`operating_cost`,`net_income`,`revenues`,`receivables`,`inventories`,`fixed_asset`,`st_prior`,`nd_prior`) VALUES ( '$_POST[kode_lk]','$_POST[current_asset]','$_POST[total_asset]','$_POST[current_liabilities]','$_POST[total_liabilities]','$_POST[gross_profit]','$_POST[operating_cost]','$_POST[net_income]','$_POST[revenues]','$_POST[receivables]','$_POST[inventories]','$_POST[fixed_asset]','$_POST[st_prior]','$_POST[nd_prior]')");
          header('location:../../media.php?module='.$module.'&stat=succeed');
      }
      elseif ($module=='data-laporan-keuangan' AND $act=='update'){
          mysql_query("UPDATE `lk` SET current_asset='$_POST[current_asset]',total_asset='$_POST[total_asset]',current_liabilities='$_POST[current_liabilities]',total_liabilities='$_POST[total_liabilities]',gross_profit='$_POST[gross_profit]',operating_cost='$_POST[operating_cost]',net_income='$_POST[net_income]',revenues='$_POST[revenues]',receivables='$_POST[receivables]',inventories='$_POST[inventories]',fixed_asset='$_POST[fixed_asset]',st_prior='$_POST[st_prior]',nd_prior='$_POST[nd_prior]'  
                                   WHERE kode_lk = '$_POST[id]'");
          header('location:../../media.php?module='.$module.'&stat=updated');
      }
}
?>
