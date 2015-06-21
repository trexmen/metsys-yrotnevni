<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
        echo "<link href='style.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
        echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
        $aksi="modul/data-laporan-keuangan/aksi-data-laporan-keuangan.php";
        switch($_GET[act]){
             
                default:
                        echo"
                        <!-- Main content -->
                        <section class='content'>
                            <div class='row'>
                                <div class='col-xs-12'>                     

                                    <div class='box'>
                                        <div class='box-header'>
                                            <h3 class='box-title'></h3>";

                                                switch($_GET['stat']){
                                                        case "succeed": echo"
                                                                    <div class='alert alert-success alert-dismissable'>
                                                                        <i class='fa fa-check'></i>
                                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                                        <b>Alert!</b> Data baru berhasil disimpan.
                                                                    </div>";
                                                                    break;
                                                        case "updated": echo"
                                                                    <div class='alert alert-info alert-dismissable'>
                                                                        <i class='fa fa-info'></i>
                                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                                        <b>Alert!</b> Data berhasil diupdate.
                                                                    </div>";
                                                                    break;
                                                        case "deleted": echo"
                                                                    <div class='alert alert-warning alert-dismissable'>
                                                                        <i class='fa alert-warning'></i>
                                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                                        <b>Alert!</b> Data baru berhasil dihapus.
                                                                    </div>";
                                                                    break;
                                                        case "failed": echo"
                                                                    <div class='alert alert-danger alert-dismissable'>
                                                                        <i class='fa fa-ban'></i>
                                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                                        <b>Alert!</b> Data baru gagal disimpan.
                                                                    </div>";
                                                                    break;                          
                                                }
                                                echo"

                                        </div><!-- /.box-header -->
                                        <div class='col-xs-12'><input type=button value='Tambah Data' onclick=location.href='?module=data-laporan-keuangan&act=tambah' class='btn btn-success pull-left'></div><br/><br/>
                                        <div class='box-body table-responsive'>
                                            <table id='example1' class='table table-bordered table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th>Kode LK</th>
                                                        <th>Curr. Asset</th>
                                                        <th>Tot. Asset</th>
                                                        <th>Curr. Liab.</th>
                                                        <th>Tot. Liab.</th>
                                                        <th>Gr. Profit</th>
                                                        <th>Op. Cost</th>
                                                        <th>Net Inc.</th>
                                                        <th>Rev.</th>
                                                        <th>Rec.</th>
                                                        <th>Inv.</th>
                                                        <th>Fix. Asset</th>
                                                        <th>1 Pr</th>
                                                        <th>2 Pr</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>";

                                                $tampil = mysql_query("SELECT * FROM lk ORDER BY kode_lk ASC");

                                                while($r=mysql_fetch_array($tampil)){
                                                    echo"
                                                    <tr>
                                                        <td>$r[kode_lk]</td>
                                                        <td>$r[current_asset]</td>
                                                        <td>$r[total_asset]</td>
                                                        <td>$r[current_liabilities]</td>
                                                        <td>$r[total_liabilities]</td>
                                                        <td>$r[gross_profit]</td>
                                                        <td>$r[operating_cost]</td>
                                                        <td>$r[net_income]</td>
                                                        <td>$r[revenues]</td>
                                                        <td>$r[receivables]</td>
                                                        <td>$r[inventories]</td>
                                                        <td>$r[fixed_asset]</td>
                                                        <td>$r[st_prior]</td>
                                                        <td>$r[nd_prior]</td>
                                                        <td><a href=?module=data-laporan-keuangan&act=edit&id=$r[kode_lk]><i class='fa fa-edit'></i> Edit</a> |  
                                                        <a href='#' id='modal-data-laporan-keuangan' act='hapus' data-id='$r[kode_lk]'><i class='fa fa-trash-o'></i> Hapus</a></td>
                                                    </tr>";
                                                }

                                                echo"
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </section><!-- /.content -->


                        ";
                        break;

                case "tambah":    
                        echo "
                        <div class='col-md-6'>
                                <!-- general form elements -->
                                <div class='box box-primary'>
                                    <div class='box-header'>
                                        <h3 class='box-title'>Tambah Data Emiten</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role='form' method=POST action='$aksi?module=data-laporan-keuangan&act=input'>
                                        <div class='box-body'>
                                            <div class='form-group'>
                                                <label for='kodeLK'>Kode LK</label>
                                                <input type='text' class='form-control' id='kode_lk' name='kode_lk' placeholder='Masukan Kode LK'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama'>Current Asset</label>
                                                <input type='number' class='form-control' id='current_asset' name='current_asset' placeholder='Masukan Currnet Asset'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='totalAsset'>Total Asset</label>
                                                <input type='number' class='form-control' id='total_asset' name='total_asset' placeholder='Masukan Total Asset'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='currentLiablilities'>Current Liablilities</label>
                                                <input type='number' class='form-control' id='current_liabilities' name='current_liabilities' placeholder='Masukan Current Liablilities'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='totalLiablilities'>Total Liablilities</label>
                                                <input type='number' class='form-control' id='total_liabilities' name='total_liabilities' placeholder='Masukan Total Liablilities' >
                                            </div>  
                                            <div class='form-group'>
                                                <label for='grossProfit'>Gross Profit</label>
                                                <input type='number' class='form-control' id='gross_profit' name='gross_profit' placeholder='Masukan Gross Profit' >
                                            </div>  
                                            <div class='form-group'>
                                                <label for='operatingCost'>Operating Cost</label>
                                                <input type='number' class='form-control' id='operating_cost' name='operating_cost' placeholder='Masukan operating_cost' >
                                            </div>  
                                            <div class='form-group'>
                                                <label for='netIncome'>Net Income</label>
                                                <input type='number' class='form-control' id='net_income' name='net_income' placeholder='Masukan net_income'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='revenues'>Revenues</label>
                                                <input type='number' class='form-control' id='revenues' name='revenues' placeholder='Masukan revenues'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='receivables'>Receivables</label>
                                                <input type='number' class='form-control' id='receivables' name='receivables' placeholder='Masukan receivables'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='inventories'>Inventories</label>
                                                <input type='number' class='form-control' id='inventories' name='inventories' placeholder='Masukan inventories'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='fixedAsset'>Fixed Asset</label>
                                                <input type='number' class='form-control' id='fixed_asset' name='fixed_asset' placeholder='Masukan fixed_asset'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='st_prior'>1 Prior</label>
                                                <input type='number' class='form-control' id='st_prior' name='st_prior' placeholder='Masukan 1 Prior'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nd_prior'>2 Prior</label>
                                                <input type='number' class='form-control' id='nd_prior' name='nd_prior' placeholder='Masukan 2 Prior'>
                                            </div>                          
                                            
                                        <div class='box-footer'>
                                            <button type='submit' class='btn btn-primary'>Simpan</button> <button type='button' onclick=self.history.back() class='btn btn-danger'>Batal</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->

                        </div><!--/.col (left) -->";
                break;

                case "edit":    
                        $edit = mysql_query("SELECT * FROM lk WHERE kode_lk='$_GET[id]'");
                        $r    = mysql_fetch_array($edit);
                        echo "
                        <div class='col-md-6'>
                                <!-- general form elements -->
                                <div class='box box-primary'>
                                    <div class='box-header'>
                                        <h3 class='box-title'>Edit Data Emiten</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role='form' method=POST action='$aksi?module=data-laporan-keuangan&act=update'>
                                    <input type=hidden name=id value=$r[kode_lk]>
                                        <div class='box-body'>
                                            <div class='form-group'>
                                                <label for='kodeLK'>Kode LK</label>
                                                <input type='text' class='form-control' id='kode_lk' name='kode_lk' placeholder='Masukan Kode LK' value='$r[kode_lk]' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama'>Current Asset</label>
                                                <input type='number' class='form-control' id='current_asset' name='current_asset' placeholder='Masukan Currnet Asset' value='$r[current_asset]'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='totalAsset'>Total Asset</label>
                                                <input type='number' class='form-control' id='total_asset' name='total_asset' placeholder='Masukan Total Asset' value='$r[total_asset]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='currentLiablilities'>Current Liablilities</label>
                                                <input type='number' class='form-control' id='current_liabilities' name='current_liabilities' placeholder='Masukan Current Liablilities' value='$r[current_liabilities]'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='totalLiablilities'>Total Liablilities</label>
                                                <input type='number' class='form-control' id='total_liabilities' name='total_liabilities' placeholder='Masukan Total Liablilities' value='$r[total_liabilities]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='grossProfit'>Gross Profit</label>
                                                <input type='number' class='form-control' id='gross_profit' name='gross_profit' placeholder='Masukan Gross Profit' value='$r[gross_profit]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='operatingCost'>Operating Cost</label>
                                                <input type='number' class='form-control' id='operating_cost' name='operating_cost' placeholder='Masukan operating_cost' value='$r[operating_cost]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='netIncome'>Net Income</label>
                                                <input type='number' class='form-control' id='net_income' name='net_income' placeholder='Masukan net_income' value='$r[net_income]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='revenues'>Revenues</label>
                                                <input type='number' class='form-control' id='revenues' name='revenues' placeholder='Masukan revenues' value='$r[revenues]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='receivables'>Receivables</label>
                                                <input type='number' class='form-control' id='receivables' name='receivables' placeholder='Masukan receivables' value='$r[receivables]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='inventories'>Inventories</label>
                                                <input type='number' class='form-control' id='inventories' name='inventories' placeholder='Masukan inventories' value='$r[inventories]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='fixedAsset'>Fixed Asset</label>
                                                <input type='number' class='form-control' id='fixed_asset' name='fixed_asset' placeholder='Masukan fixed_asset' value='$r[fixed_asset]'>
                                            </div>  
                                            <div class='form-group'>
                                                <label for='st_prior'>1 Prior</label>
                                                <input type='number' class='form-control' id='st_prior' name='st_prior' placeholder='Masukan 1 Prior' value='$r[st_prior]'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nd_prior'>2 Prior</label>
                                                <input type='number' class='form-control' id='nd_prior' name='nd_prior' placeholder='Masukan 2 Prior' value='$r[nd_prior]'>
                                            </div>                                
                                            
                                        <div class='box-footer'>
                                            <button type='submit' class='btn btn-primary'>Update</button> <button type='button' onclick=self.history.back() class='btn btn-danger'>Batal</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->

                        </div><!--/.col (left) -->";
                break;  
        }
}
?>
