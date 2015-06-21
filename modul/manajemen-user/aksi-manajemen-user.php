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
      $act=$_GET['act'];

      $lokasi_file    = $_FILES['fupload']['tmp_name'];
      $tipe_file      = $_FILES['fupload']['type'];
      $nama_file      = $_FILES['fupload']['name'];
      $acak           = rand(000000,999999);
      $nama_file_unik = $acak.$nama_file; 

      
      if ($module=='manajemen-user' AND $act=='hapus'){
          $data=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_GET[id]'"));
          if (($foto['foto']!='')||($foto['foto']!='avatar.png')){
              mysql_query("DELETE FROM users WHERE username='$_GET[id]'");
              unlink("../../upload_foto/$data[foto]");
              unlink("../../upload_foto/medium_$data[foto]");   
              unlink("../../upload_foto/small_$data[foto]");
          }
          else{
              mysql_query("DELETE FROM users WHERE username='$_GET[id]'");  
          }   
          header('location:../../media.php?module='.$module.'&stat=deleted');
      }
      elseif ($module=='manajemen-user' AND $act=='input'){
          if (empty($lokasi_file)){
                mysql_query("INSERT INTO `users`(`nama_lengkap`,`email`,`no_telp`,`level`,`status`,`username`) VALUES('$_POST[nama_lengkap]','$_POST[email]','$_POST[telepon]','$_POST[level]','$_POST[status]','$_POST[username]')");
                header('location:../../media.php?module='.$module.'&stat=succeed');
          }
          else{
                if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpg"){
                      header('location:../../media.php?module='.$module.'&stat=failed');
                }
                else{
                      UploadImage($nama_file_unik);
                      mysql_query("INSERT INTO `users`(`nama_lengkap`,`email`,`no_telp`,`level`,`status`,`username`,`foto`) VALUES('$_POST[nama_lengkap]','$_POST[email]','$_POST[telepon]','$_POST[level]','$_POST[status]','$_POST[username]','$nama_file_unik')");
                      header('location:../../media.php?module='.$module.'&stat=succeed');                      
                }
          }
                        
      }
      elseif ($module=='manajemen-user' AND $act=='update'){              
              if(empty($_POST['password_baru'])){
                    if (empty($lokasi_file)){
                          mysql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                                        email  = '$_POST[email]',
                                                        no_telp  = '$_POST[telepon]',
                                                        level  = '$_POST[level]',
                                                        status =  '$_POST[status]'
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
                                                        foto = '$nama_file_unik',
                                                        status =  '$_POST[status]'
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
                                                        password  = MD5('$_POST[password_baru]',
                                                        status =  '$_POST[status]')
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
                                                        foto = '$nama_file_unik',
                                                        status =  '$_POST[status]'
                                                        WHERE username   = '$_POST[id]'");
                                header('location:../../media.php?module='.$module.'&stat=updated');
                          }
                    }
              }
      }

}
?>
