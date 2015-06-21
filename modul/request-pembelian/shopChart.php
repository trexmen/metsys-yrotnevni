<?php

include "ModelShopChart.php";

$modOrder = new ModelShopChart();
$listOrder = $modOrder->getListOrder();

echo "<h1>Shopping Chart</h1>";

echo "<br/><br/>";
echo "<form method='post' action='doProcess.php?aksi=update'>";
echo "<table border='1'>";
echo "<tr>";
echo "<td>No.</td>";
echo "<td>ID</td>";
echo "<td>Name</td>";
echo "<td>Price</td>";
echo "<td>Qty</td>";
echo "<td>Sub Total</td>";
echo "<td>Action</td>";
echo "</tr>";

$no = 0;
$total = 0;
foreach ($listOrder as $key => $value) {
  echo "<tr>";
  echo "<td>" . ++$no . "</td>";
  echo "<td>" . $value->id_product . "</td>";
  echo "<td>" . $value->product_name . "</td>";
  echo "<td>" . $value->price . "</td>";
  echo "<td><input type='text' name='txtQty_" . $key . "' value='" . $value->qty . "' style='border:0; width:40px' /></td>";
  echo "<td>" . $value->sub_total . "</td>";
  echo "<td><a href='doProcess.php?aksi=hapus&ord=" . $key . "'>Delete</a></td>";
  echo "</tr>";

  $total+= $value->sub_total;
}

echo "<tr>";
echo "<td colspan='5' style='text-align:right'>Total</td>";
echo "<td>" . $total . "</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "</table>";
echo "<br/>";
echo "<input type='submit' name='bCalculateTotal' value='Update Total Pembelian' />";
echo "</form>";

echo "<br/><br/>";
echo "<a href='index.php'>Lanjutkan Belanja</a>";
?>
