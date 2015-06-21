<?php 
$act=$_POST['act'];
$aksi="modul/manajemen-user/aksi-manajemen-user.php";
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
                        <form id='update_profil' role='form' data-toggle='validator' method=POST action='$aksi?module=manajemen-user&act=input' enctype='multipart/form-data'>
                        <div class='box-body'>
                            <div class='form-group'>
                                <label for='namaLengkap'>Nama Lengkap</label>
                                <input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap' placeholder='Masukan Nama Lengkap' required>
                            </div>
                            <div class='form-group'>
                                <label for='email'>Email</label>
                                <input type='email' class='form-control' id='email' name='email' data-error='Oops, tidak sesuai dengan format email..' placeholder='Masukan Email'>
                                <div class='help-block with-errors'></div>
                            </div>
                            <div class='form-group'>
                                <label for='telepon'>Nomor Telepon</label>
                                <input type='text' class='form-control' id='telepon' name='telepon' pattern='^([+0-9]){6,}$' data-error='Oops, tidak sesuai dengan format nomor telepon..' placeholder='Masukan Telepon'>
                            </div>                            
                            <div class='form-group'>
                                <label>Jabatan / Level</label>
                                <select class='form-control' id='level' name='level' required>
                                      <option value='admin'>Admin</option>
                                      <option value='user' selected>User</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label>Status</label>
                                <div class='radio'>
                                      <label>
                                          <input type='radio' name='status' id='status' value='Y' checked>
                                          Aktif
                                      </label>
                                </div>
                                <div class='radio'>
                                      <label>
                                          <input type='radio' name='status' id='status' value='N'>
                                          Non Aktif
                                      </label>
                                </div>                                
                            </div>
                            <div class='form-group'>
                                <label for='username'>Username</label>
                                <input type='text' class='form-control' id='username' name='username' placeholder='Masukan Username' required>
                            </div>
                            <div class='form-group'>
                                <label for='passwordBaru'>Password Baru</label>
                                <input type='password' data-minlength='5' class='form-control' id='password_baru' name='password_baru' placeholder='Masukan Password Baru' required>
                                <span class='help-block'>Minimum of 5 characters</span>
                            </div>
                            <div class='form-group'>
                                <label for='ulangiPassword'>Ulangi Password Baru</label>
                                <input type='password' class='form-control' id='ulangi_password' name='ulangi_password' data-match='#password_baru' data-match-error='Oops, password tidak sama'placeholder='Ulangi Password Baru' required>
                                <div class='help-block with-errors'></div>
                            </div>                            
                            <div class='form-group'>
                                <label for='foto'>Foto</label><br/>
                                <input type='file' name='fupload'>
                                <span class='help-block'>*) Size 225 x 225 pixels, Tipe gambar harus JPG/JPEG.</span>
                                        
                            </div>                               
                            
                        	<div class='modal-footer'>
			                	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                  				<button type='submit' class='simpan btn btn-primary'>Simpan</button>			                    
			                </div>
                    	</form>
                    	</div
			        </div><!-- /.box -->";
}
elseif($act=="edit")
{
	$id=$_POST['id'];
	$edit = mysql_query("SELECT * FROM users WHERE username='$id'");
    $r = mysql_fetch_array($edit);
	echo "
		    <!-- general form elements -->
                    <div class='box box-primary'>
                        <div class='box-header'>
                            <h3 class='box-title'>Edit Data User</h3>
                        </div><!-- /.box-header -->
                        <form id='update_profil' role='form' data-toggle='validator' method=POST action='$aksi?module=manajemen-user&act=update' enctype='multipart/form-data'>
                        <input type=hidden name='id' value=$r[username]>
                        <div class='box-body'>
                            <div class='form-group'>
                                <label for='namaLengkap'>Nama Lengkap</label>
                                <input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap' placeholder='Masukan Nama Lengkap' value='$r[nama_lengkap]'>
                            </div>
                            <div class='form-group'>
                                <label for='email'>Email</label>
                                <input type='email' class='form-control' id='email' name='email' data-error='Oops, tidak sesuai dengan format email..' placeholder='Masukan Email' value='$r[email]'>
                                <div class='help-block with-errors'></div>
                            </div>
                            <div class='form-group'>
                                <label for='telepon'>Nomor Telepon</label>
                                <input type='text' class='form-control' id='telepon' name='telepon' pattern='^([+0-9]){6,}$' data-error='Oops, tidak sesuai dengan format nomor telepon..' placeholder='Masukan Telepon' value='$r[no_telp]'>
                            </div>                            
                            <div class='form-group'>
                                <label>Jabatan / Level</label>
                                <select class='form-control' id='level' name='level'>";
                                if($r['level'] == 'admin'){
                                  echo"<option value='admin' selected>Admin</option>
                                       <option value='user'>User</option>";
                                }
                                elseif($r['level'] == 'user'){
                                  echo"<option value='admin'>Admin</option>
                                       <option value='user' selected>User</option>";
                                }
 
                            echo "</select>
                            </div>
                            <div class='form-group'>
                            <label>Status</label>";
                              if($r['status'] == 'Y'){
                                  echo"<div class='radio'>
                                        <label>
                                            <input type='radio' name='status' id='status' value='Y' checked>
                                            Aktif
                                        </label>
                                        </div>
                                        <div class='radio'>
                                            <label>
                                                <input type='radio' name='status' id='status' value='N'>
                                                Non Aktif
                                            </label>
                                        </div>";
                                }
                                elseif($r['status'] == 'N'){
                                  echo"<div class='radio'>
                                        <label>
                                            <input type='radio' name='status' id='status' value='Y'>
                                            Aktif
                                        </label>
                                        </div>
                                        <div class='radio'>
                                            <label>
                                                <input type='radio' name='status' id='status' value='N' checked>
                                                Non Aktif
                                            </label>
                                        </div>";
                                }

                                echo"                                
                            </div>
                            <div class='form-group'>
                                <label for='username'>Username</label>
                                <input type='text' class='form-control' id='username' name='username' placeholder='Masukan Username' value='$r[username]' readonly>
                            </div>
                            <div class='form-group'>
                                <label for='passwordBaru'>Password Baru</label>
                                <input type='password' data-minlength='5' class='form-control' id='password_baru' name='password_baru' placeholder='Masukan Password Baru'>
                                <span class='help-block'>Minimum of 5 characters</span>
                            </div>
                            <div class='form-group'>
                                <label for='ulangiPassword'>Ulangi Password Baru</label>
                                <input type='password' class='form-control' id='ulangi_password' name='ulangi_password' data-match='#password_baru' data-match-error='Oops, password tidak sama'placeholder='Ulangi Password Baru' >
                                <div class='help-block with-errors'></div>
                            </div>                            
                            <div class='form-group'>
                                <label for='foto'>Foto</label><br/>
                                <img src='upload_foto/$r[foto]' >
                                <input type='file' name='fupload'>
                                <span class='help-block'>*) Size 225 x 225 pixels, Tipe gambar harus JPG/JPEG.</span>
                                        
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
	$edit = mysql_query("SELECT * FROM users WHERE username='$id'");
	$r    = mysql_fetch_array($edit);
	
	echo"
	<form role='form' method=POST action='$aksi?module=manajemen-user&act=hapus&id=$r[username]'>
		<div class='box-body'>
			<label>Hapus data $r[nama_lengkap] ($r[username]) ?</label>
		</div>
		<div class='modal-footer'>
		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
					<button type='submit' class='simpan btn btn-primary'>Ya</button>			                    
		</div>
	</form>
	";
}

?>