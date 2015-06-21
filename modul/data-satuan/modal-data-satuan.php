<?php 
$act=$_POST['act'];
$aksi="modul/data-satuan/aksi-data-satuan.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA SATUAN -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-satuan&act=input'>
			                <div class='box-body'>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Satuan</label>
			                        <input type='text' class='form-control' id='nama_satuan' name='nama_satuan'  placeholder='Masukan Nama satuan' required>
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
	$edit = mysql_query("SELECT * FROM satuan WHERE id_satuan='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-satuan&act=update'>
		        	<input type=hidden name='id_satuan' value=$r[id_satuan]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='nama_satuan'>Nama Satuan</label>
		                    <input type='text' class='form-control' id='nama_satuan' name='nama_satuan' placeholder='Masukan Nama satuan' value='$r[nama_satuan]' required>
		                </div>            
		            <div class='modal-footer'>
			                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
			        </div>
		        </form>
		    </div><!-- /.box -->";

}

?>