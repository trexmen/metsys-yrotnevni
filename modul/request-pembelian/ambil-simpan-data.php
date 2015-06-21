<?php

// include "db/koneksi.php";
include "../../config/koneksi.php";
include "../../config/format-rupiah.php";
include "ModelProduct.php";
include "ModelShopChart.php";

$aksi="modul/request-pembelian/ambil-simpan-data.php";
$op=isset($_GET['op'])?$_GET['op']:null;

//Ambil Data Barang Dari SELECT BOX yang belum ada datanya di tabel DETAIL_PENJUALAN_TMP
if($op=='ambilbarang')
{
    //$data=mysql_query("SELECT b.`id_barang`,b.`nama_barang` FROM `barang` b LEFT OUTER JOIN `penjualan_tmp` p USING(id_barang) WHERE p.`id_barang` IS NULL");
    $data=mysql_query("SELECT `id_barang`,`nama_barang` FROM `barang` ORDER BY nama_barang ASC");
    echo"<option>--Pilih Barang--</option>";
    while($r=mysql_fetch_array($data))
    {
        echo "<option value='$r[id_barang]'>$r[nama_barang]</option>";
    }
}

//Ambil data inputan dari SELECT BOX nama barang pada proses transaksi
elseif($op=='ambildatabarang')
{
    $id_barang=$_GET['id_barang'];
    $dt=mysql_query("SELECT * FROM barang WHERE id_barang='$id_barang'");
    $d=mysql_fetch_array($dt);
    echo $d['nama_barang']."|".$d['harga_beli']."|".$d['stok'];
}

//MENAMPILKAN PADA DATA DETAIL BARANG YANG  DIBELI (TABEL DETAIL PENJUALAN)
elseif($op=='barang')
{   
        $modOrder = new ModelShopChart();
        $listOrder = $modOrder->getListOrder();

        echo "<thead>
            <tr>
                <th>No.</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead><tbody>";

        $no = 0;
        $total = 0;        
        foreach ($listOrder as $key => $value) {
          echo "<tr>";
          echo "<td>" . ++$no . "</td>";
          echo "<td>" . $value->id_product . "<input type='hidden' name='txtID_" . $key . "' value='" . $value->id_product . "'></td>";
          echo "<td>" . $value->product_name . "</td>";
          echo "<td align='right'>" . format_rupiah($value->price) . "</td>";
          echo "<td align='center'><input type='text' name='txtQty_" . $key . "' value='" . $value->qty . "' style='border:0; width:40px' /></td>";
          echo "<td align='right'>" . format_rupiah($value->sub_total) . "</td>";
          echo "<td><a href='#' id='button_delete_" . $key . "'><i class='fa fa-trash-o'></i> Hapus</a></td>";
          echo "</tr>";

          echo"<script type='text/javascript'>
                $('input[name^=txtQty_" . $key . "]').on('keyup',function () {
                        var id_barang = $('input[name^=txtID_" . $key . "]').val();
                        var jumlah = $('input[name^=txtQty_" . $key . "]').val();
                        $.ajax({
                            url:'modul/request-pembelian/ambil-simpan-data.php',
                            data:'op=update&id_barang='+id_barang+'&jumlah='+jumlah,
                            cache:false,
                            success:function(msg){
                                if(msg!='sukses'){                                    
                                    //alertShow('Update Berhasil..');
                                    //window.location='media.php?module=request-pembelian';
                                   
                                }else{
                                    //$('#status').html('Transaksi Gagal');
                                    alertShow('Update Gagal..');
                                    
                                }
                                $('#pcs_id_barang').load('modul/request-pembelian/ambil-simpan-data.php','op=ambilbarang');
                                $('#pcs_barang').load('modul/request-pembelian/ambil-simpan-data.php','op=barang');
                            }
                        })
                });

                $('#button_delete_" . $key . "').on('click',function () {
                        var index = $key;
                        $.ajax({
                            url:'modul/request-pembelian/ambil-simpan-data.php',
                            data:'op=hapus&index='+index,
                            cache:false,
                            success:function(msg){
                                if(msg!='sukses'){                                    
                                    //alertShow('Hapus Berhasil..');
                                    //window.location='media.php?module=request-pembelian';
                                   
                                }else{
                                    //$('#status').html('Transaksi Gagal');
                                    alertShow('Update Gagal..');
                                    
                                }
                                $('#pcs_id_barang').load('modul/request-pembelian/ambil-simpan-data.php','op=ambilbarang');
                                $('#pcs_barang').load('modul/request-pembelian/ambil-simpan-data.php','op=barang');
                            }
                        })
                });

                $('input[name^=txtQty_" . $key . "]').keypress(function (e) {

                     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        alertShow('Maaf, hanya inputkan angka..');            
                        return false;
                        $('input[name^=txtQty_" . $key . "]').focus();
                    }

                });

            </script>";

          $total+= $value->sub_total;
        } //tutup looping

        

        echo "</tbody></tfooter><tr>";
        echo "<td colspan='5' style='text-align:right'>Total</td>";
        echo "<td align='right'>" .format_rupiah($total) . "<input type='hidden' id='total' value='".$total."'></td>";
        echo "<td>&nbsp;</td>";
        echo "</tr></tfooter>";
}

elseif($op=='tambah')
{
    // $id_barang=$_GET['id_barang'];
    // $nama_barang=$_GET['nama_barang'];
    // $harga_beli=$_GET['harga_beli'];
    // $jumlah=$_GET['jumlah'];
    // $subtotal=$harga_beli*$jumlah;
    
    // $tambah=mysql_query("INSERT INTO penjualan_tmp(id_barang,nama_barang,harga_beli,jumlah,subtotal)
    //                     VALUES('$id_barang','$nama_barang','$harga_beli','$jumlah','$subtotal')");
    
    // if($tambah){
    //     echo "sukses";
    // }else{
    //     echo "error";
    // }
}

elseif($op=='update')
{

    $id_barang=$_GET['id_barang'];
    $jumlah=$_GET['jumlah'];

    $modOrder = new ModelShopChart();
    $listOrder = $modOrder->getListOrder();

      foreach ($listOrder as $key => $value) {
        if(($value->id_product)==$id_barang){
        $newQty = $jumlah;
        $value->qty = $newQty;
        $value->setSubTotal();}
      }

      $modOrder->updateSession($listOrder);
}

elseif($op=='hapus')
{
    $ordIndex = $_GET['index'];

    $modOrder = new ModelShopChart();
    $modOrder->deleteOrder($ordIndex);
}

elseif($op=='simpan')
{
    $nota=$_GET['nota'];
    $tgl_pengajuan=$_GET['tgl_pengajuan'];
    $id_pelanggan=$_GET['id_supplier'];
    $id_karyawan=$_GET['id_karyawan'];
    $minggu=$_GET['minggu'];
    $total=$_GET['total'];
    //$idKaryawan = $_SESSION[id_karyawan];
    $simpan=mysql_query("INSERT INTO purchasing(`id_purchasing`,`id_karyawan`,`id_supplier`,`minggu`,`tgl_pengajuan`,`tgl_pemesanan`,`catatan`,`status`,`total`)
                    VALUES ('$nota','$id_karyawan','$id_supplier','$minggu',NULL,NULL,NULL,'N','".$total."')");
    

    if($simpan)
    {
        $modOrder = new ModelShopChart();
        $listOrder = $modOrder->getListOrder(); 
        foreach ($listOrder as $key => $value) {     
            mysql_query("INSERT INTO detail_purchasing(id_purchasing,id_barang,harga_beli,jumlah,subtotal)
                            VALUES('$nota','".$value->id_product."','".$value->price."','".$value->qty."','".$value->sub_total."')");

            mysql_query("UPDATE barang SET stok=stok-'".$value->qty."'
                        WHERE id_barang='".$value->id_product."");

            //Delete isi session satu persatu
            unset($listOrder[$key]);
            $modOrder->updateSession($listOrder);
        }

        echo "sukses";
    }
    else
    {
        echo "error";
    }
}
?>
