<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
      echo "<link href='style.css' rel='stylesheet' type='text/css'>
      <center>Untuk mengakses modul, Anda harus login <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
      include "../../config/koneksi.php";
      include "../../config/fungsi_thumb.php";

      $module=$_GET['module'];

      $lokasi_file    = $_FILES['fupload']['tmp_name'];
      $tipe_file      = $_FILES['fupload']['type'];
      $nama_file      = $_FILES['fupload']['name'];
      $acak           = rand(000000,999999);
      $nama_file_unik = $acak.$nama_file; 

      // Apabila gambar tidak diganti
      if(empty($_POST['password_baru'])){
            if (empty($lokasi_file)){
                  mysql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                                email  = '$_POST[email]',
                                                no_telp  = '$_POST[telepon]',
                                                level  = '$_POST[level]'
                                                WHERE username = '$_POST[id]'");
                  header('location:../../media.php?module='.$module.'&stat=updated');
            }
            else{
                  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpg"){
                        header('location:../../media.php?module='.$module.'&stat=failed');
                  }
                  else{
                        $foto=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_POST[id]'"));
                        if (($foto['foto']!='')&&($foto['foto']!='avatar.png')){
                            unlink("../../upload_foto/$foto[foto]");
                            unlink("../../upload_foto/medium_$foto[foto]");   
                            unlink("../../upload_foto/small_$foto[foto]");
                        }
                        UploadImage($nama_file_unik);
                        mysql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                                email  = '$_POST[email]',
                                                no_telp  = '$_POST[telepon]',
                                                level  = '$_POST[level]',
                                                foto = '$nama_file_unik'
                                                WHERE username   = '$_POST[id]'");
                        header('location:../../media.php?module='.$module.'&stat=updated');
                  }
            }
      }
      else{
          if (empty($lokasi_file)){
                  mysql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                                email  = '$_POST[email]',
                                                no_telp  = '$_POST[telepon]',
                                                level  = '$_POST[level]',
                                                password  = MD5('$_POST[password_baru]')
                                                WHERE username = '$_POST[id]'");
                  header('location:../../media.php?module='.$module.'&stat=updated');
            }
            else{
                  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpg"){
                        header('location:../../media.php?module='.$module.'&stat=failed');
                  }
                  else{
                        $foto=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_POST[id]'"));
                        if (($foto['foto']!='')&&($foto['foto']!='avatar.png')){
                            unlink("../../upload_foto/$foto[foto]");
                            unlink("../../upload_foto/medium_$foto[foto]");   
                            unlink("../../upload_foto/small_$foto[foto]");
                        }
                        UploadImage($nama_file_unik);
                        mysql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                                email  = '$_POST[email]',
                                                no_telp  = '$_POST[telepon]',
                                                level  = '$_POST[level]',
                                                password  = MD5('$_POST[password_baru]'),
                                                foto = '$nama_file_unik'
                                                WHERE username   = '$_POST[id]'");
                        header('location:../../media.php?module='.$module.'&stat=updated');
                  }
            }
      }
}
?>
