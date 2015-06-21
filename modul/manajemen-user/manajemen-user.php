<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
    echo"
    <!-- Main content -->
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>                 

                <div class='box'>
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
                                    <i class='fa fa-warning'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>Alert!</b> Data baru berhasil dihapus.
                                </div>";
                                break;
                    case "failed": echo"
                                <div class='alert alert-danger alert-dismissable'>
                                    <i class='fa fa-ban'></i>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <b>Alert!</b> Data baru gagal disimpan.
                                </div>";
                                break;                      
                    }
                echo"

                    </div><!-- /.box-header -->
                    <div class='col-xs-12'>
                    <input type='button' value='Tambah User' id='modal-manajemen-user' act='tambah' class='btn btn-primary pull-left'></div><br/><br/>
                    <div class='box-body table-responsive'>
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";

                $tampil = mysql_query("SELECT * FROM users ORDER BY username ASC");

                while($r=mysql_fetch_array($tampil)){
                  echo"
                                <tr>
                                    <td>$r[username]</td>
                                    <td>$r[nama_lengkap]</td>
                                    <td>$r[email]</td>
                                    <td>$r[no_telp]</td>
                                    <td>$r[level]</td>
                                    <td>";if($r[status]!='Y'){echo"<i class='fa fa-minus-circle'> Non Aktif</i>";}else{echo"<i class='fa fa-check'> Aktif</i>";} echo"</td>
                                    <td><a href='#' id='modal-manajemen-user' act='edit' data-id='$r[username]'><i class='fa fa-edit'></i> Edit</a> | ";
                                    if($_SESSION['username'] != $r['username']){ echo"<a href='#' id='modal-manajemen-user' act='hapus' data-id='$r[username]'><i class='fa fa-trash-o'></i> Hapus</a>";} echo"</td>
                                </tr>";
                            }
                            
                            echo"
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->";
}
?>
