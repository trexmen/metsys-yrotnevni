<?php
// definisikan koneksi ke database
$server = "localhost";
$username = "root";
$password = "";
$database = "inventory_system";

// $server = "sql102.my-php.net";
// $username = "my_8456742";
// $password = "warsimdasem";
// $database = "my_8456742_latihan";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

?>
