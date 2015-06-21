<?php 
$act=$_POST['act'];
$aksi="modul/data-jabatan/aksi-data-jabatan.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA JABATAN -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
			                <h3 class='box-title'></h3>
			            </div><!-- /.box-header -->
			            <!-- form start -->
			            <form role='form' method='POST' action='$aksi?module=data-jabatan&act=input'>
			                <div class='box-body'>
			                    <div class='form-group'>
			                        <label for='nama'>Nama Jabatan</label>
			                        <input type='text' class='form-control' id='nama_jabatan' name='nama_jabatan'  placeholder='Masukan Nama Jabatan' required>
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
	$edit = mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$id'");
	$r    = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
		    <div class='box box-primary'>
		        <div class='box-header'>
		            <h3 class='box-title'></h3>
		        </div><!-- /.box-header -->
		        <!-- form start -->
		        <form role='form' method=POST action='$aksi?module=data-jabatan&act=update'>
		        	<input type=hidden name='id_jabatan' value=$r[id_jabatan]>
		            <div class='box-body'>
		                <div class='form-group'>
		                    <label for='nama_jabatan'>Nama Jabatan</label>
		                    <input type='text' class='form-control' id='nama_jabatan' name='nama_jabatan' placeholder='Masukan Nama Jabatan' value='$r[nama_jabatan]' required>
		                </div>            
		            <div class='modal-footer'>
			                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
			        </div>
		        </form>
		    </div><!-- /.box -->";

}

?>