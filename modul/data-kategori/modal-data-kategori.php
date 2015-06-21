<?php 
$act=$_POST['act'];
$aksi="modul/data-kategori/aksi-data-kategori.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA KATEGORI -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-kategori&act=input'>
			                <div class='box-body'>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Kategori</label>
			                        <input type='text' class='form-control' id='nama_kategori' name='nama_kategori'  placeholder='Masukan Nama kategori' required>
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
	$edit = mysql_query("SELECT * FROM kategori WHERE id_kategori='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-kategori&act=update'>
		        	<input type=hidden name='id_kategori' value=$r[id_kategori]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='nama_kategori'>Nama Kategori</label>
		                    <input type='text' class='form-control' id='nama_kategori' name='nama_kategori' placeholder='Masukan Nama kategori' value='$r[nama_kategori]' required>
		                </div>            
		            <div class='modal-footer'>
			                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
			        </div>
		        </form>
		    </div><!-- /.box -->";

}

?>