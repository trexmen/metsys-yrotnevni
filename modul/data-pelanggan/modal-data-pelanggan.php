<?php 
$act=$_POST['act'];
$aksi="modul/data-pelanggan/aksi-data-pelanggan.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA PELANGGAN -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-pelanggan&act=input'>
			                <div class='box-body'>";
                                $c=mysql_fetch_array(mysql_query("SELECT CONCAT('C',LPAD(COUNT(id_pelanggan)+1,4,'0')) AS 'id_pelanggan' FROM pelanggan"));                            
                                echo"
			                    <div class='form-group'>
			                        <label for='id_pelanggan'>ID Pelanggan</label>
			                        <input type='text' class='form-control' id='id_pelanggan' name='id_pelanggan' value='$c[id_pelanggan]' placeholder='Masukan ID Pelanggan' disabled>
			                    </div>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Pelanggan</label>
			                        <input type='text' class='form-control' id='nama_pelanggan' name='nama_pelanggan'  placeholder='Masukan Nama Pelanggan' required>
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
	$edit = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-pelanggan&act=update'>
		        	<input type=hidden name=id value=$r[id_pelanggan]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='id_pelanggan'>ID Pelanggan</label>
		                    <input type='text' class='form-control' id='id_pelanggan' name='id_pelanggan' placeholder='Masukan ID Pelanggan' value='$r[id_pelanggan]' disabled>
		                </div>
		                <div class='form-group'>
		                    <label for='nama_pelanggan'>Nama</label>
		                    <input type='text' class='form-control' id='nama_pelanggan' name='nama_pelanggan' placeholder='Masukan Nama Pelanggan' value='$r[nama_pelanggan]' required>
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
	$edit = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-pelanggan&act=hapus&id=$r[id_pelanggan]'>
		<div class='box-body'>
			<label>Hapus data $r[nama_pelanggan] ($r[id_pelanggan]) ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>