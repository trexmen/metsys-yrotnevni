<?php 
$act=$_POST['act'];
$aksi="modul/data-laporan-keuangan/aksi-data-laporan-keuangan.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA EMITEN -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
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
                                    
                                <div class='modal-footer'>
				                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
	                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
				                </div>
                            </form> 
			        </div><!-- /.box -->";
}
elseif($act=="edit")
{
	$id=$_POST['id'];
	$edit = mysql_query("SELECT * FROM lk WHERE kode_lk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
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
                        
                        <div class='modal-footer'>
				                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
	                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
				        </div>
                </form>        
		    </div><!-- /.box -->";

}
elseif($act=="hapus")
{
	$id=$_POST['id'];
	$edit = mysql_query("SELECT * FROM lk WHERE kode_lk='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-laporan-keuangan&act=hapus&id=$r[kode_lk]'>
		<div class='box-body'>
			<label>Hapus data dengan Kode LK $r[kode_lk] ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>