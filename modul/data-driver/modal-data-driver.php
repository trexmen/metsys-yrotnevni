<?php 
$act=$_POST['act'];
$aksi="modul/data-driver/aksi-data-driver.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA DRIVER -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-driver&act=input'>
			                <div class='box-body'>";
                                $d=mysql_fetch_array(mysql_query("SELECT CONCAT('D',LPAD(COUNT(id_driver)+1,4,'0')) AS 'id_driver' FROM driver"));
                            
                                echo"
			                    <div class='form-group'>
			                        <label for='id_driver'>ID Driver</label>
			                        <input type='text' class='form-control' id='id_driver' name='id_driver' value='$d[id_driver]' placeholder='Masukan ID Driver' disabled>
			                    </div>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Driver</label>
			                        <input type='text' class='form-control' id='nama_driver' name='nama_driver'  placeholder='Masukan Nama Driver' required>
			                    </div>
			                    <div class='form-group'>
			                        <label for='sektor'>Alamat</label>
			                        <input type='text' class='form-control' id='alamat' name='alamat'placeholder='Masukan Alamat'>
			                    </div>  
			                    <div class='form-group'>
			                        <label for='telepon'>Telepon</label>
			                        <input type='text' class='form-control' id='telepon' name='telepon' placeholder='Masukan Telepon'>
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
	$edit = mysql_query("SELECT * FROM driver WHERE id_driver='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-driver&act=update'>
		        	<input type=hidden name=id value=$r[id_driver]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='id_driver'>ID Driver</label>
		                    <input type='text' class='form-control' id='id_driver' name='id_driver' placeholder='Masukan ID driver' value='$r[id_driver]' disabled>
		                </div>
		                <div class='form-group'>
		                    <label for='nama_driver'>Nama Driver</label>
		                    <input type='text' class='form-control' id='nama_driver' name='nama_driver' placeholder='Masukan Nama Driver' value='$r[nama_driver]' required>
		                </div>
		                <div class='form-group'>
		                    <label for='alamat'>Alamat</label>
		                    <input type='text' class='form-control' id='alamat' name='alamat' placeholder='Masukan Alamat' value='$r[alamat]'>
		                </div>  
		                <div class='form-group'>
		                    <label for='telepon'>Telepon</label>
		                    <input type='text' class='form-control' id='telepon' name='telepon' placeholder='Masukan Telepon' value='$r[telepon]'>
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
	$edit = mysql_query("SELECT * FROM driver WHERE id_driver='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-driver&act=hapus&id=$r[id_driver]'>
		<div class='box-body'>
			<label>Hapus data $r[nama_driver] ($r[id_driver]) ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>