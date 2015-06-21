<?php
    $query=mysql_query("SELECT `nama_barang`,
                               `jumlah`,
                               `satuan`,
                               detail_penjualan.`harga_jual`,
                               `id_penjualan`,
                               `id_pengiriman`,
                               `nama_pelanggan`,
                               `alamat`
                        FROM `penjualan` JOIN `detail_penjualan` USING (`id_penjualan`)
                                         JOIN `barang` USING (`id_barang`)
                                         JOIN `pelanggan` USING (`id_pelanggan`) 
                        WHERE id_penjualan ='$_GET[id]'");
                              
    $r=mysql_fetch_array($query);
    $invoice = mysql_num_rows(mysql_query("SELECT * FROM penjualan"));
    $grand_total=mysql_fetch_array(mysql_query("SELECT SUM(jumlah * detail_penjualan.`harga_jual`) AS `grand_total`,`id_penjualan` ,`id_pengiriman`,`pelanggan`.`nama_pelanggan`,`pelanggan`.`alamat`
                                                FROM `penjualan` JOIN `detail_penjualan` USING(id_penjualan) JOIN `barang` USING(id_barang) JOIN `pelanggan` USING (id_pelanggan) 
                                                WHERE id_penjualan='FJ-1301-0005'"));
                                                                            $skarang= format_tanggal_lengkap(date('Y-m-d'));

    $j =mysql_fetch_array(mysql_query("SELECT DATE_ADD(NOW(),INTERVAL 7 DAY)  AS jatuh_tempo FROM penjualan WHERE id_penjualan ='$_GET[id]'"));
    $jatuh_tempo = format_tanggal($j['jatuh_tempo']);
    echo"
              <!-- Main content -->
                <section class='content invoice'>
                    <!-- title row -->
                    <div class='row'>
                        <div class='col-xs-12'>
                            <h2 class='page-header'>
                                <i><img src='img/logo.png' width='75px'></i> CV.Gypsum Griya Indah
                                <small class='pull-right'>$hari_ini, $skarang</small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class='row invoice-info'>
                        <div class='col-sm-4 invoice-col'>
                            Dari :
                            <address>
                                <strong>Suwarto</strong><br>
                                Jl.Raya Bogares Kidul, <br>
                                Pangkah - Tegal, Jawa Tengah<br>
                                Telp./Fax.(0283) 619556<br/>
                                Email : fakhruroji@gypsumgriyaindah.com
                            </address>
                        </div><!-- /.col -->
                        <div class='col-sm-4 invoice-col'>
                            Kepada Yth :
                            <address>
                                <strong>$r[nama_pelanggan]</strong><br>
                                $r[alamat]<br>
                                Telp. (0260) 551907<br/>
                            </address>
                        </div><!-- /.col -->
                        <div class='col-sm-4 invoice-col'>
                            <b>Invoice     : #$invoice</b><br/>
                            <br/>
                            <b>No. Nota    :</b> $r[id_penjualan]<br/>
                            <b>Jatuh Tempo :</b> $jatuh_tempo <br/>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class='row'>
                        <div class='col-xs-12 table-responsive'>
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                $no=1;
                                $query= mysql_query("SELECT nama_barang,jumlah,satuan,detail_penjualan.`harga_jual`,jumlah*detail_penjualan.`harga_jual` AS `total`
                                                    FROM `penjualan` JOIN `detail_penjualan` USING (`id_penjualan`)
                                                             JOIN `barang` USING(`id_barang`)
                                                             JOIN `pelanggan` USING (`id_pelanggan`)
                                                    WHERE id_penjualan='$_GET[id]'");
                                while($r=mysql_fetch_array($query)){
                                $subtotal = format_rupiah($r['total']);
                                $harga = format_rupiah($r['harga_jual']);                                
                                echo"                                
                                    <tr>
                                        <td>$no</td>
                                        <td>$r[nama_barang]</td>
                                        <td>$harga</td>                                        
                                        <td>$r[jumlah]</td>
                                        <td>$r[satuan]</td>
                                        <td>$subtotal</td>
                                    </tr>";
                                    $no++;
                                }
                                echo"    
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class='row'>
                        <!-- accepted payments column -->
                        <div class='col-xs-6'>
                            <p class='lead'>Metode Pembayaran :</p>
                            <img src='img/bni.jpg' alt='Bank BNI' style='margin-right:10px; height:30px'/> 
                            <img src='img/bca.jpg' alt='Bank BCA' style='margin-right:10px; height:30px''/> 
                            <img src='img/mandiri.jpg' alt='Bank Mandiri' style='margin-right:10px; height:30px''/> 
                            <p class='text-muted well well-sm no-shadow' style='margin-top: 10px;'>
                                Rek. Bank BNI &emsp;&emsp;: 02152222 A/N Tarkiman <br/>
                                Rek. Bank BCA &emsp;&emsp;: 02152222 A/N Tarkiman <br/>
                                Rek. Bank MANDIRI : 02152222 A/N Tarkiman <br/>
                            </p>
                        </div><!-- /.col -->
                        <div class='col-xs-6'>
                            <p class='lead'>Jatuh Tempo $jatuh_tempo</p>
                            <div class='table-responsive'>
                                <table class='table'>
                                    <tr>
                                        <th style='width:50%'>Subtotal&emsp;&emsp;:</th>
                                        <td>".format_rupiah($grand_total['grand_total'])."</td>
                                    </tr>
                                    <tr>
                                        <th>Pajak (0%) &emsp;:</th>
                                        <td>".format_rupiah(0)."</td>
                                    </tr>
                                    <tr>
                                        <th>Biaya Pengiriman :</th>
                                        <td>".format_rupiah(0)."</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>".format_rupiah($grand_total['grand_total'])."</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class='row no-print'>
                        <div class='col-xs-12'>
                            <button class='btn btn-primary' onclick='window.print();'><i class='fa fa-print'></i> Print</button>
                            <button class='btn btn-success' onclick=\"window.location.href='?module=transaksi-penjualan';\"><i class='fa fa-credit-card'></i> Tambah Transaksi</button>
                            <!--<button class='btn btn-success pull-right'><i class='fa fa-credit-card'></i> Submit Payment</button>
                            <button class='btn btn-primary pull-right' style='margin-right: 5px;'><i class='fa fa-download'></i> Generate PDF</button>-->
                        </div>
                    </div>
                </section><!-- /.content -->";
?>
