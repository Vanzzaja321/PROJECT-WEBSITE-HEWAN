<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_db = "db_hewan";

$koneksi = mysqli_connect("localhost","root","","db_hewan");

if( !$koneksi){
    die("Gagal terhubung dengan database:" .mysqli_connect_error());
}

?>
