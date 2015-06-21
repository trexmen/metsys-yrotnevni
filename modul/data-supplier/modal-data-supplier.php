<?php 
$act=$_POST['act'];
$aksi="modul/data-supplier/aksi-data-supplier.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA SUPPLIER -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-supplier&act=input'>
			                <div class='box-body'>";
                                $s=mysql_fetch_array(mysql_query("SELECT CONCAT('S',LPAD(COUNT(id_supplier)+1,4,'0')) AS 'id_supplier' FROM supplier"));
                            
                                echo"
			                    <div class='form-group'>
			                        <label for='id_supplier'>ID Supplier</label>
			                        <input type='text' class='form-control' id='id_supplier' name='id_supplier' value='$s[id_supplier]' placeholder='Masukan ID supplier' disabled>
			                    </div>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Supplier</label>
			                        <input type='text' class='form-control' id='nama_supplier' name='nama_supplier'  placeholder='Masukan Nama supplier' required>
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
	$edit = mysql_query("SELECT * FROM supplier WHERE id_supplier='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-supplier&act=update'>
		        	<input type=hidden name=id value=$r[id_supplier]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='id_supplier'>ID Supplier</label>
		                    <input type='text' class='form-control' id='id_supplier' name='id_supplier' placeholder='Masukan ID supplier' value='$r[id_supplier]' disabled>
		                </div>
		                <div class='form-group'>
		                    <label for='nama_supplier'>Nama Supplier</label>
		                    <input type='text' class='form-control' id='nama_supplier' name='nama_supplier' placeholder='Masukan Nama supplier' value='$r[nama_supplier]' required>
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
	$edit = mysql_query("SELECT * FROM supplier WHERE id_supplier='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-supplier&act=hapus&id=$r[id_supplier]'>
		<div class='box-body'>
			<label>Hapus data $r[nama_supplier] ($r[id_supplier]) ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>