<?php 
$act=$_POST['act'];
$aksi="modul/data-barang/aksi-data-barang.php";
include "../../config/koneksi.php";
if($act=="tambah"){
		echo"
		<!-- MODAL TAMBAH DATA BARANG -->
         <!-- general form elements -->
			        <div class='box box-primary'>
			            <div class='box-header'>
                            <h3 class='box-title'></h3>
                        </div><!-- /.box-header -->
			            <!-- form start -->
                                <form id='tambah-data-barang' role='form' data-toggle='validator' method='POST' action='$aksi?module=data-barang&act=input' enctype='multipart/form-data'>
                                <div class='box-body'>";
                                            $b=mysql_fetch_array(mysql_query("SELECT CONCAT('P',LPAD(COUNT(id_barang)+1,4,'0')) AS 'id_barang' FROM barang"));
                                        
                                            echo"
                                            <div class='form-group'>
                                                <label for='id_barang'>ID Barang</label>
                                                <input type='text' class='form-control' id='id_barang' name='id_barang' value='$b[id_barang]' placeholder='Masukan ID Barang' disabled>
                                            </div>
                                            <div class='form-group'>
                                                <label for='nama_barang'>Nama Barang</label>
                                                <input type='text' class='form-control' id='nama_barang' name='nama_barang' placeholder='Masukan Nama Barang'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='kategori'>Kategori</label>
                                                <select class='form-control' id='id_kategori' name='id_kategori' required><option value='' selected>-- Pilih Kategori --</option>";
                                                $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
                                                while($r=mysql_fetch_array($tampil))
                                                {
                                                  echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
                                                }
                                                echo"
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='stok'>Stok</label>
                                                <input type='number' class='form-control' id='stok' name='stok' placeholder='Masukan Stok Barang'>
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label for='satuan'>Satuan</label>
                                                <select class='form-control' id='satuan' name='satuan' required>
                                                      <option value='' selected>-- Pilih Satuan --</option>
                                                      <option value='Lembar'>Lembar</option>
                                                      <option value='Sak'>Sak</option>
                                                </select>
                                            </div>                                                                                       
                                            <div class='form-group'>
                                                <label for='harga_jual'>Harga Jual</label>
                                                <input type='number' class='form-control' id='harga_jual' name='harga_jual' placeholder='Masukan Harga Jual' required>
                                            </div>
                                            <div class='form-group'>
                                                <label for='harga_beli'>Harga Beli</label>
                                                <input type='number' class='form-control' id='harga_beli' name='harga_beli' placeholder='Masukan Harga Beli' required>
                                            </div>                        
                                            <div class='form-group'>
                                                <label for='foto'>Foto Barang</label><br/>
                                                <input type='file' name='fupload'>
                                                <span class='help-block'>*) Size 225 x 225 pixels, Tipe foto harus JPG/JPEG.</span>
                                                        
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
	$edit = mysql_query("SELECT * FROM barang WHERE id_barang='$id'");
    $r = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
                    <div class='box box-primary'>
                        <div class='box-header'>
                            <h3 class='box-title'></h3>
                        </div><!-- /.box-header -->


                        <!-- form start -->
                            <form id='edit-data-barang' role='form' data-toggle='validator' method='POST' action='$aksi?module=data-barang&act=update' enctype='multipart/form-data'>
                            <div class='box-body'>
                                        <div class='form-group'>
                                            <label for='id_barang'>ID Barang</label>
                                            <input type='text' class='form-control' id='id_barang' name='id_barang' value='$r[id_barang]' placeholder='Masukan ID Barang' required readonly>
                                        </div>
                                        <div class='form-group'>
                                            <label for='nama_barang'>Nama Barang</label>
                                            <input type='text' class='form-control' id='nama_barang' name='nama_barang' value='$r[nama_barang]' placeholder='Masukan Nama Barang'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='kategori'>Kategori</label>
                                            <select class='form-control' id='id_kategori' name='id_kategori' required><option value='' selected>-- Pilih Kategori --</option>";
                                            
                                            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
                                            if ($r[id_kategori]=='')
                                            {
                                                echo "<option value='$r[id_kategori]' selected>$r[nama_kategori]</option>";
                                            }
                                            while($w=mysql_fetch_array($tampil))
                                            {
                                                if ($r[id_kategori]==$w[id_kategori])
                                                {
                                                    echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
                                                }
                                            }

                                            echo"
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for='stok'>Stok</label>
                                            <input type='number' class='form-control' id='stok' name='stok' value='$r[stok]' placeholder='Masukan Stok Barang'>
                                        </div>
                                    
                                        <div class='form-group'>
                                            <label for='satuan'>Satuan</label>
                                            <select class='form-control' id='satuan' name='satuan' required>
                                                  <option value='$r[satuan]' selected>$r[satuan]</option>
                                                  <option value='Lembar'>Lembar</option>
                                                  <option value='Sak'>Sak</option>
                                            </select>
                                        </div>                                                                                       
                                        <div class='form-group'>
                                            <label for='harga_jual'>Harga Jual</label>
                                            <input type='number' class='form-control' id='harga_jual' name='harga_jual' value='$r[harga_jual]' placeholder='Masukan Harga Jual' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='harga_beli'>Harga Beli</label>
                                            <input type='number' class='form-control' id='harga_beli' name='harga_beli' value='$r[harga_beli]' placeholder='Masukan Harga Beli' required>
                                        </div>                        
                                        <div class='form-group'>
                                            <label for='foto'>Foto</label><br/>";
                                            if ($r['foto']!='')
                                            {
                                                echo "<img src='upload_foto/small_$r[foto]'>";  
                                            }
                                            else
                                            {
                                                echo "<img src='upload_foto/avatar.png'>";
                                            }
                                            echo"
                                            <input type='file' name='fupload'>
                                            <span class='help-block'>*) Size 225 x 225 pixels, Tipe gambar harus JPG/JPEG.</span>
                                                    
                                        </div> 
                                    
                                                                  
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                                            <button type='submit' class='simpan btn btn-primary'>Simpan</button>                                
                                        </div>
                                                        
                            </div>
                            </form>
                    </div><!-- /.box -->";         
		            

}
elseif($act=="hapus")
{
	$id=$_POST['id'];
	$edit = mysql_query("SELECT * FROM barang WHERE id_barang='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=data-barang&act=hapus&id=$r[id_barang]'>
		<div class='box-body'>
			<label>Hapus data $r[nama_barang]  ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>