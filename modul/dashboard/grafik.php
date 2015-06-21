<?php

include "../../config/koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='ambildatabarang')
{
	$sth = mysql_query("SELECT `nama_barang`,`stok` FROM `barang` ORDER BY `stok` ASC LIMIT 3");
	$rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	    $rows[] = $r;
	}
	echo json_encode($rows);
}


else if($op=='ambildatapenjualan')
{
	$sth = mysql_query("SELECT j.`minggu`,SUM(j.`total`) AS 'total_penjualan',SUM(p.`total`) AS 'total_pembelian'
                         FROM `penjualan` j LEFT OUTER JOIN `purchasing` p ON j.`minggu` = p.`minggu`
                        GROUP BY j.minggu LIMIT 12");
	$rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	    $rows[] = $r;
	}
	echo json_encode($rows);
}

else if($op=='presentasePenjualan')
{
	$query = mysql_query("SELECT SUM(dp.`jumlah`) AS 'total' 
						  FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`) 
						  					 JOIN `barang` b USING(`id_barang`) 
						  WHERE YEAR(p.`tgl_pemesanan`) = '2013'");
	$data = mysql_fetch_array($query);
	$total = $data['total'];
	$sth = mysql_query("SELECT ROUND(((SUM(dp.`jumlah`)/297657)*100),2) AS 'value',b.`nama_barang` AS 'label'
						FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`)
		 				                   JOIN `barang` b USING(`id_barang`)
						WHERE YEAR(p.`tgl_pemesanan`) = '2013'
		 				GROUP BY dp.`id_barang`");
	$rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	     $rows[] = $r;
	 }
	echo json_encode($rows);
	//echo "total : ".$data['total'];
}
?>
