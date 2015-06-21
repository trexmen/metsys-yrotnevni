<?php
include "../../config/koneksi.php";
$query1 = mysql_query("SELECT COUNT(*) AS 'baru' FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`)
                                 JOIN `barang` b USING(`id_barang`)
                        WHERE p.`tgl_pengiriman` IS NULL");
$data1 = mysql_fetch_array($query1);
$baru = $data1['baru'];

$query2 = mysql_query("SELECT COUNT(p.`tgl_pengiriman`) AS 'jumlah' FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`)
                                 JOIN `barang` b USING(`id_barang`)
                        WHERE MONTH(p.`tgl_pemesanan`) = '05'");
$data2 = mysql_fetch_array($query2);
$jumlahPengiriman = $data2['jumlah'];

$query3 = mysql_query("SELECT SUM(p.`total`) AS 'omset' FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`)
                                 JOIN `barang` b USING(`id_barang`)
                        WHERE MONTH(p.`tgl_pemesanan`) = '05'");
$data3 = mysql_fetch_array($query3);
$omset = format_rupiah($data3['omset']);

$query4 = mysql_query("SELECT SUM(dp.`harga_jual`- b.`harga_beli`) AS 'revenue' FROM `penjualan` p JOIN `detail_penjualan` dp USING(`id_penjualan`)
                                 JOIN `barang` b USING(`id_barang`)
                        WHERE MONTH(p.`tgl_pemesanan`) = '05'");
$data4 = mysql_fetch_array($query4);
$untung = format_rupiah($data4['revenue']);



echo"
                    <!-- Small boxes (Stat box) -->
                    <div class='row'>
                        <div class='col-lg-3 col-xs-6'>
                            <!-- small box -->
                            <div class='small-box bg-aqua'>
                                <div class='inner'>
                                    <h3>
                                        ".$baru."
                                    </h3>
                                    <p>
                                        Pemesanan Baru
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-bag'></i>
                                </div>
                                <a href='?module=data-penjualan' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div><!-- ./col -->                        
                        <div class='col-lg-3 col-xs-6'>
                            <!-- small box -->
                            <div class='small-box bg-yellow'>
                                <div class='inner'>
                                    <h3>
                                        ".$jumlahPengiriman."
                                    </h3>
                                    <p>
                                        Pengiriman Hari Ini
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-ios7-cart-outline'></i>
                                </div>
                                <a href='?module=data-penjualan' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class='col-lg-3 col-xs-6'>
                            <!-- small box -->
                            <div class='small-box bg-red'>
                                <div class='inner'>
                                    <h3>
                                        ".$omset."
                                    </h3>
                                    <p>
                                        Omset Bulan Ini
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-pie-graph'></i>
                                </div>
                                <a href='?module=data-penjualan' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class='col-lg-3 col-xs-6'>
                            <!-- small box -->
                            <div class='small-box bg-green'>
                                <div class='inner'>
                                    <h3>
                                        ".$untung."
                                    </h3>
                                    <p>
                                        Keuntungan Bulan Ini
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-stats-bars'></i>
                                </div>
                                <a href='?module=data-penjualan' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class='row'>
                        <div class='col-xs-12 connectedSortable'>
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class='row'>
                        <!-- Left col -->
                        <section class='col-lg-6 connectedSortable'> 
                            <!-- Box (with bar chart) -->
                            <div class='box box-danger' id='loading-example'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <button class='btn btn-danger btn-sm refresh-btn' data-toggle='tooltip' title='Reload'><i class='fa fa-refresh'></i></button>
                                        <button class='btn btn-danger btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn btn-danger btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                    </div><!-- /. tools -->
                                    <i class='fa fa-cloud'></i>

                                    <h3 class='box-title'>Data Stock Barang</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <!-- bar chart -->
                                            <div class='chart' id='bar2-chart' style='height: 250px;'></div>
                                        </div>                                        
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                <div class='box-footer'>
                                    <div class='row'>
                                        <div class='col-xs-4 text-center' style='border-right: 1px solid #f4f4f4'>
                                            <input type='text' class='knob' data-readonly='true' value='75' data-width='60' data-height='60' data-fgColor='#f56954'/>
                                            <div class='knob-label'>A</div>
                                        </div><!-- ./col -->
                                        <div class='col-xs-4 text-center' style='border-right: 1px solid #f4f4f4'>
                                            <input type='text' class='knob' data-readonly='true' value='37' data-width='60' data-height='60' data-fgColor='#00a65a'/>
                                            <div class='knob-label'>B</div>
                                        </div><!-- ./col -->
                                        <div class='col-xs-4 text-center'>
                                            <input type='text' class='knob' data-readonly='true' value='59' data-width='60' data-height='60' data-fgColor='#3c8dbc'/>
                                            <div class='knob-label'>C</div>
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->        
                            
                                                                     
                            
                        </section><!-- /.Left col -->


                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class='col-lg-6 connectedSortable'>
                            
                            <!-- Chart Line box -->
                            <div class='box box-primary'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <!-- <button class='btn btn-primary btn-sm refresh-btn' data-toggle='tooltip' title='Reload'><i class='fa fa-refresh'></i></button> -->
                                        <button class='btn btn-primary btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn btn-primary btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                    </div><!-- /. tools -->
                                    <i class='fa fa-inbox'></i>
                                    <h3 class='box-title'>Penjualan dan Purchasing</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>

                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class='nav-tabs-custom'>
                                        <!-- Tabs within a box -->
                                        <ul class='nav nav-tabs pull-right'>
                                            <li class='active'><a href='#revenue2-chart' data-toggle='tab'>Nilai Penjualan & Purchasing</a></li>
                                            <li><a href='#presentasePenjualan-chart' data-toggle='tab'>Presentase Penjualan</a></li>
                                            <!-- <li class='pull-left header'><i class='fa fa-inbox'></i> Sales</li> -->
                                        </ul>
                                        <div class='tab-content no-padding'>
                                            <!-- Morris chart - Sales -->
                                            <div class='chart tab-pane active' id='revenue2-chart' style='position: relative; height: 300px;'></div>
                                            <div class='chart tab-pane' id='presentasePenjualan-chart' style='position: relative; height: 300px;'></div>
                                        </div>
                                    </div><!-- /.nav-tabs-custom -->
                                </div>     
                            </div>
                            <!-- /.box -->                           

                        </section><!-- right col -->


                    </div><!-- /.row (main row) -->
";

?>












<?php

                    //  <!-- Main row -->
                    // <div class="row">
                    //     <!-- Left col -->
                    //     <section class="col-lg-6 connectedSortable"> 
                    //         <!-- Box (with bar chart) -->
                    //         <div class="box box-danger" id="loading-example">
                    //             <div class="box-header">
                    //                 <!-- tools box -->
                    //                 <div class="pull-right box-tools">
                    //                     <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                    //                     <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    //                     <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    //                 </div><!-- /. tools -->
                    //                 <i class="fa fa-cloud"></i>

                    //                 <h3 class="box-title">Data Stock Barang</h3>
                    //             </div><!-- /.box-header -->
                    //             <div class="box-body no-padding">
                    //                 <div class="row">
                    //                     <div class="col-sm-7">
                    //                         <!-- bar chart -->
                    //                         <div class="chart" id="batang-chart" style="height: 250px;"></div>
                    //                     </div>
                    //                     <div class="col-sm-5">
                    //                         <div class="pad">
                    //                             <!-- Progress bars -->
                    //                             <div class="clearfix">
                    //                                 <span class="pull-left">Gypsum Aplus</span>
                    //                                 <small class="pull-right">825 Lembar</small>
                    //                             </div>
                    //                             <div class="progress xs">
                    //                                 <div class="progress-bar progress-bar-green" style="width: 82%;"></div>
                    //                             </div>

                    //                             <div class="clearfix">
                    //                                 <span class="pull-left">Cornice Adhesive</span>
                    //                                 <small class="pull-right">725 Sak</small>
                    //                             </div>
                    //                             <div class="progress xs">
                    //                                 <div class="progress-bar progress-bar-red" style="width: 72%;"></div>
                    //                             </div>

                    //                             <div class="clearfix">
                    //                                 <span class="pull-left">Jaya Board</span>
                    //                                 <small class="pull-right">350 Sak</small>
                    //                             </div>
                    //                             <div class="progress xs">
                    //                                 <div class="progress-bar progress-bar-light-blue" style="width: 35%;"></div>
                    //                             </div>

                    //                             <div class="clearfix">
                    //                                 <span class="pull-left">Hollow</span>
                    //                                 <small class="pull-right">450 Batang</small>
                    //                             </div>
                    //                             <div class="progress xs">
                    //                                 <div class="progress-bar progress-bar-aqua" style="width: 45%;"></div>
                    //                             </div>
                    //                             <!-- Buttons -->
                    //                             <p>
                    //                                 <button class="btn btn-default btn-sm"><i class="fa fa-cloud-download"></i> Generate PDF</button>
                    //                             </p>
                    //                         </div><!-- /.pad -->
                    //                     </div><!-- /.col -->
                    //                 </div><!-- /.row - inside box -->
                    //             </div><!-- /.box-body -->
                    //             <div class="box-footer">
                    //                 <div class="row">
                    //                     <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    //                         <input type="text" class="knob" data-readonly="true" value="75" data-width="60" data-height="60" data-fgColor="#f56954"/>
                    //                         <div class="knob-label">CPU</div>
                    //                     </div><!-- ./col -->
                    //                     <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    //                         <input type="text" class="knob" data-readonly="true" value="37" data-width="60" data-height="60" data-fgColor="#00a65a"/>
                    //                         <div class="knob-label">Disk</div>
                    //                     </div><!-- ./col -->
                    //                     <div class="col-xs-4 text-center">
                    //                         <input type="text" class="knob" data-readonly="true" value="59" data-width="60" data-height="60" data-fgColor="#3c8dbc"/>
                    //                         <div class="knob-label">RAM</div>
                    //                     </div><!-- ./col -->
                    //                 </div><!-- /.row -->
                    //             </div><!-- /.box-footer -->
                    //         </div><!-- /.box -->        
                            
                                                                     
                            
                    //     </section><!-- /.Left col -->
                    //     <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    //     <section class="col-lg-6 connectedSortable">
                            
                    //         <!-- Chart Line box -->
                    //         <div class="box box-primary">
                    //             <div class="box-header">
                    //                 <!-- tools box -->
                    //                 <div class="pull-right box-tools">
                    //                     <!-- <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button> -->
                    //                     <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    //                     <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    //                 </div><!-- /. tools -->
                    //                 <i class="fa fa-inbox"></i>
                    //                 <h3 class="box-title">Sales</h3>
                    //             </div><!-- /.box-header -->
                    //             <div class="box-body no-padding">

                    //                 <!-- Custom tabs (Charts with tabs)-->
                    //                 <div class="nav-tabs-custom">
                    //                     <!-- Tabs within a box -->
                    //                     <ul class="nav nav-tabs pull-right">
                    //                         <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    //                         <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    //                         <!-- <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li> -->
                    //                     </ul>
                    //                     <div class="tab-content no-padding">
                    //                         <!-- Morris chart - Sales -->
                    //                         <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    //                         <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    //                     </div>
                    //                 </div><!-- /.nav-tabs-custom -->
                    //             </div>     
                    //         </div>
                    //         <!-- /.box -->                           

                    //     </section><!-- right col -->
                    // </div><!-- /.row (main row) -->


?>
