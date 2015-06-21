<?php
include "../../config/koneksi.php";
class ModelProduct {

  public $id_product;
  public $product_name;
  public $price;

  public function getList() {
    $dtListProduct = array();

    $tampil = mysql_query("SELECT   `barang`.`id_barang`       AS `id_barang`,
                                    `barang`.`id_kategori`     AS `id_kategori`,
                                    `kategori`.`nama_kategori` AS `nama_kategori`,
                                    `barang`.`nama_barang`     AS `nama_barang`,
                                    `barang`.`stok`            AS `stok`,
                                    `barang`.`satuan`          AS `satuan`,
                                    `barang`.`harga_beli`      AS `harga_beli`,
                                    `barang`.`harga_jual`      AS `harga_jual`,
                                    `barang`.`foto`            AS `foto`,
                                    `barang`.`safety_stock`    AS `safety_stock`,
                                    `barang`.`order_quantity`  AS `order_quantity`,
                                    `barang`.`lead_time`       AS `lead_time`
                                  FROM (`barang` JOIN `kategori` ON ((`barang`.`id_kategori` = `kategori`.`id_kategori`))) ORDER BY `id_barang` ASC");
                                     


                while($r=mysql_fetch_array($tampil)){

                    $newProduct = new ModelProduct();
                    $newProduct->id_product = $r['id_barang'];
                    $newProduct->product_name = $r['nama_barang'];
                    $newProduct->price = $r['harga_beli'];
                    array_push($dtListProduct, $newProduct);
                }

    return $dtListProduct;
  }

  public function getByIndex($dataIndex) {
    $listProduct = $this->getList();
    $dataProduct = $listProduct[$dataIndex];

    return $dataProduct;
  }

}

?>
