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
										                <i class='fa alert-warning'></i>
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
		                <input type='button' value='Tambah Data' id='modal-data-supplier' act='tambah' class='btn btn-primary pull-left'></div><br/><br/>
		                <div class='box-body table-responsive'>
		                    <table id='example1' class='table table-bordered table-striped'>
		                        <thead>
		                            <tr>
		                                <th>ID supplier</th>
		                                <th>Nama supplier</th>
		                                <th>Alamat</th>
		                                <th>Telepon</th>
		                                <th>Aksi</th>
		                            </tr>
		                        </thead>
		                        <tbody>";

								$tampil = mysql_query("SELECT * FROM supplier ORDER BY id_supplier ASC");

								while($r=mysql_fetch_array($tampil)){
									echo"
		                            <tr>
		                                <td>$r[id_supplier]</td>
		                                <td>$r[nama_supplier]</td>
		                                <td>$r[alamat]</td>
		                                <td>$r[telepon]</td>
		                                <td><a href='#' id='modal-data-supplier' act='edit' data-id='$r[id_supplier]'><i class='fa fa-edit'></i> Edit</a> |  
		                                <a href='#' id='modal-data-supplier' act='hapus' data-id='$r[id_supplier]'><i class='fa fa-trash-o'></i> Hapus</a></td>
		                            </tr>";
		                        }

		                        echo"
		                        </tbody>
		                    </table>
		                </div><!-- /.box-body -->
		            </div><!-- /.box -->
		        </div>
		    </div>
		</section><!-- /.content -->
		";	
}
?>
