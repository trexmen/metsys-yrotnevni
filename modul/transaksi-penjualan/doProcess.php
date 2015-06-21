<?php

include "ModelProduct.php";
include "ModelShopChart.php";

$action = isset($_GET['aksi']) ? $_GET['aksi'] : '';
if ($action == 'tambah') {
  $prodIndex = isset($_GET['id_barang']) ? $_GET['id_barang'] : 0;

  $model = new ModelProduct();
  $dataProduct = $model->getByIndex($prodIndex);

  if ($dataProduct->id_product = $_GET['id_barang']) {
    $newOrder = new ModelShopChart();
    $newOrder->id_product = $dataProduct->id_product;
    $newOrder->product_name = $_GET['nama_barang'];
    $newOrder->price = $_GET['harga_jual'];
    $newOrder->qty = $_GET['jumlah'];
    $newOrder->addOrder();
  }

  //header("location:shopChart.php");
} else if ($action == 'update') {
  $modOrder = new ModelShopChart();
  $listOrder = $modOrder->getListOrder();

  foreach ($listOrder as $key => $value) {
    $newQty = $_POST["txtQty_" . $key];
    $value->qty = $newQty;
    $value->setSubTotal();
  }

  $modOrder->updateSession($listOrder);

  header("location:shopChart.php");
} else if ($action == 'hapus') {
  $ordIndex = isset($_GET['id_barang']) ? $_GET['id_barang'] : 0;

  $modOrder = new ModelShopChart();
  $modOrder->deleteOrder($ordIndex);

  //header('location:../../media.php?module=transaksi-penjualan');
}
?>
