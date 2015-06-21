<?php 
$aksi="modul/update-profil/aksi-update-profil.php";
session_start();
include "../../config/koneksi.php";
$edit = mysql_query("SELECT * FROM users WHERE username='$_SESSION[username]'");
$r = mysql_fetch_array($edit);
echo "
<!-- general form elements -->
    <!-- general form elements -->
        <div class='box box-primary'>
            <div class='box-header'>
                <h3 class='box-title'></h3>";
        switch($_GET['stat']){
            case "succeed": echo"
                        <div class='alert alert-success alert-dismissable'>
                            <i class='fa fa-check'></i>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <b>Alert!</b> Data baru berhasil disimpan.
                        </div>";
                        break;
            case "updated": echo"
                        <div class='alert alert-info alert-dismissable'>
                            <i class='fa fa-info'></i>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <b>Alert!</b> Data berhasil diupdate.
                        </div>";
                        break;
            case "deleted": echo"
                        <div class='alert alert-warning alert-dismissable'>
                            <i class='fa alert-warning'></i>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <b>Alert!</b> Data baru berhasil dihapus.
                        </div>";
                        break;
            case "failed": echo"
                        <div class='alert alert-danger alert-dismissable'>
                            <i class='fa fa-ban'></i>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <b>Alert!</b>Data baru gagal disimpan, Pastikan File yang di Upload bertipe *.JPG
                        </div>";
                        break;                      
        }
      echo"
            </div><!-- /.box-header -->
            <!-- form start -->
            <form id='update_profil' role='form' data-toggle='validator' method=POST action='$aksi?module=update-profil' enctype='multipart/form-data'>
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
                        <label for='level'>Jabatan / Level</label>
                        <input type='text' class='form-control' id='level' name='level' placeholder='Masukan Level' value='$r[level]' readonly>
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
                                
                    </div>                               
                    
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>
                        <button type='submit' class='simpan btn btn-primary'>Simpan</button>                                
                    </div>
            </form>
        </div><!-- /.box -->";         
		            


?>