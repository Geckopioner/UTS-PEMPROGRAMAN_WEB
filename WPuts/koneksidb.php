<?php
$db_host    = "localhost";
$db_user    = "root";
$db_pass    = "";
$db_name    = "dbakademik";

$cnn    = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


// koneksi setelah sukses
if (!$cnn){
    die("koneksi gagal!");
};

