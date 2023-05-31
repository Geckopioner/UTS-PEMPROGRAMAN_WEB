<?php
include_once("koneksidb.php");
session_start();

if (!isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    header('location: login.php');
}

$nim          = "";
$nama         = "";
$alamat       = "";
$email        = "";
$jurusan      = "";
$sukses       = "";
$error        = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') { // DELETE untuk menghapus data
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM tbmahasiswa WHERE id = '$id'";
    $hasil1     = mysqli_query($cnn, $sql1);
    if ($hasil1) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'datamahasiswa.php';
        </script>";
    } else {
        $error = "Gagal melakukan hapus data";
    }
}

?>