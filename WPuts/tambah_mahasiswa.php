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

if ($op == 'update') {
    $id     = $_GET['id'];
    $sql1   = "SELECT * FROM tbmahasiswa WHERE id = '$id'";
    $hasil1 = mysqli_query($cnn, $sql1);
    $r1         = mysqli_fetch_array($hasil1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $alamat     = $r1['alamat'];
    $email      = $r1['email'];
    $jurusan    = $r1['jurusan'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // CREATE 
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $email      = $_POST['email'];
    $jurusan    = $_POST['jurusan'];

    if ($nim && $nama && $alamat && $email && $jurusan) {
        if ($op == 'update') { // UPDATE untuk mengedit data
            $sql1       = "UPDATE tbmahasiswa SET nim = '$nim',nama='$nama',alamat='$alamat',email='$email',jurusan='$jurusan' WHERE id = '$id'";
            $hasil1     = mysqli_query($cnn, $sql1);
            if ($hasil1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { // INSERT
            $sql    = "INSERT INTO tbmahasiswa (nim, nama, alamat, email, jurusan) VALUES ('$nim','$nama','$alamat','$email','$jurusan')";
            $hasil  = mysqli_query($cnn, $sql);
            if ($hasil) {
                $sukses     = "Berhasil menambahkan data baru";
            } else {
                $error      = "Gagal menambahkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Mahasiswa</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>


    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="datamahasiswa.php">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="datamatkul.php">Mata kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="datadosen.php">Dosen</a>
                        </li>
                    </ul>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-danger btn-sm me-md-2" data-bs-toggle="modal" data-bs-target="#myModal">Sign out</button></a>
                </div>
                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Log Out</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Apakah yakin ingin keluar?
                             <!-- Modal footer -->
        <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal </button>
                                <a href="logout.php"><button type="button" class="btn btn-primary">Yakin</button></a>
                            </div>
                            </div>

                            
                        </div>
        </nav>
        
    </div>

    <div class="container mt-3">
            <!-- CREATE untuk menambahkan data -->
            <div class="card">
                <div class="card-header">
                    Create Data
                </div>
                <div class="card-body">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                        header("refresh: 3 ;url=datamahasiswa.php"); // akan refresh otomatis dalam 3 detik
                    }
                    ?>
                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-info" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php
                        header("refresh: 3 ;url=datamahasiswa.php"); // akan refresh otomatis dalam 3 detik
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <option value="" selected disabled> - Pilih Jurusan - </option>
                                    <option value="TI-Manajemen Data dan Informasi" <?php if ($jurusan == "TI-Manajemen Data dan Informasi") echo "selected" ?>> TI-Manajemen Data dan Informasi </option>
                                    <option value="TI-Komputer Akuntansi dan Bisnis" <?php if ($jurusan == "TI-Komputer Akuntansi dan Bisnis") echo "selected" ?>> TI-Komputer Akuntansi dan Bisnis </option>
                                    <option value="TI-Bisnis Digital" <?php if ($jurusan == "TI-pariwisata") echo "selected" ?>> Bisnis Digital </option>
                                    <option value="Sistem Komputer" <?php if ($jurusan == "Sistem Komputer") echo "selected" ?>> Sistem Komputer </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Save" class="btn btn-primary">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>