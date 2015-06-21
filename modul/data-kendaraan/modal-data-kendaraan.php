<?php 
$act=$_POST['act'];
$aksi="modul/data-kendaraan/aksi-data-kendaraan.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA kendaraan -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-kendaraan&act=input'>
			                <div class='box-body'>
			                    <div class='form-group'>
			                        <label for='no_kendaraan'>Nomor Kendaraan</label>
			                        <input type='text' class='form-control' id='no_kendaraan' name='no_kendaraan' placeholder='Masukan Nomor Kendaraan' required>
			                    </div>
			                    <div class='form-group'>
			                        <label for='nama'>Merek Kendaraan</label>
			                        <input type='text' class='form-control' id='merek' name='merek'  placeholder='Masukan Merek Kendaraan' required>
			                    </div>
			                    <div class='form-group'>
			                        <label for='sektor'>Tahun</label>
			                        <input type='text' class='form-control' id='tahun' name='tahun'placeholder='Masukan Tahun'>
			                    </div>  	                                 
				                <div class='modal-footer'>
				                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
	                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
				                </div>
			                </div>
			            </form>
			        </div><!-- /.box -->";
}
elseif($act=="edit")
{
	$id=$_POST['id'];
	$edit = mysql_query("SELECT * FROM kendaraan WHERE no_kendaraan='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-kendaraan&act=update'>
		        	<input type=hidden name=id value=$r[no_kendaraan]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='no_kendaraan'>Nomor Kendaraan</label>
		                    <input type='text' class='form-control' id='no_kendaraan' name='no_kendaraan' placeholder='Masukan Nomor Kendaraan' value='$r[no_kendaraan]' disabled>
		                </div>
		                <div class='form-group'>
		                    <label for='merek'>Merek Kendaraan</label>
		                    <input type='text' class='form-control' id='merek' name='merek' placeholder='Masukan Merek Kendaraan' value='$r[merek]' required>
		                </div>
		                <div class='form-group'>
		                    <label for='tahun'>Tahun</label>
		                    <input type='text' class='form-control' id='tahun' name='tahun' placeholder='Masukan Tahun' value='$r[tahun]'>
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
	$edit = mysql_query("SELECT * FROM kendaraan WHERE no_kendaraan='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-kendaraan&act=hapus&id=$r[no_kendaraan]'>
		<div class='box-body'>
			<label>Hapus data $r[merek] ($r[no_kendaraan]) ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>