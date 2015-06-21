<?php

session_start();

class ModelShopChart {

  public $id_product;
  public $product_name;
  public $price;
  public $qty;
  public $sub_total;

  public function setSubTotal() {
    $this->sub_total = $this->price * $this->qty;
  }

  public function getListOrder() {
    $listOrder = isset($_SESSION['dtOrder']) ? $_SESSION['dtOrder'] : array();
    return $listOrder;
  }

  public function getOrderByIndex($dataIndex) {
    $listOrder = $this->getListOrder();
    $dataOrder = $listOrder[$dataIndex];

    return $dataOrder;
  }

  public function updateSession($value) {
    $_SESSION['dtOrder'] = $value;
  }

  public function addOrder() {
    $listOrder = $this->getListOrder();
    $existIndex = $this->searchOrder($this->id_product);

    if ($existIndex < 0) {
      $this->setSubTotal();
      array_push($listOrder, $this);
    } else {
      $updateOrder = $this->getOrderByIndex($existIndex);
      $updateOrder->qty+= $this->qty;
      $updateOrder->setSubTotal();

      $listOrder[$existIndex] = $updateOrder;
    }

    $this->updateSession($listOrder);
  }

  public function deleteOrder($indexOrder) {
    $listOrder = $this->getListOrder();
    unset($listOrder[$indexOrder]);

    $this->updateSession($listOrder);
  }

  public function searchOrder($idProduct) {
    $indexFound = -1;
    $exist = False;
    $listOrder = $this->getListOrder();
    foreach ($listOrder as $key => $value) {
      if ($idProduct == $value->id_product) {
        $exist = True;
        $indexFound = $key;
        break;
      }
    }

    return $indexFound;
  }

}

?>
