<?php
    include 'koneksidb.php';
?>

<?php
include_once("koneksidb.php");
session_start();

if (!isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>

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

    <div class="dashboard container"> <br> <br>
        <!-- READ untuk menampilkan data -->
<div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Mahasiswa
                    <a href="tambah_mahasiswa.php" class="btn btn-sm btn-dark">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        <tbody>
                            <?php
                            $sql1       = "SELECT * FROM tbmahasiswa ORDER BY id DESC";
                            $hasil1     = mysqli_query($cnn, $sql1);
                            $urut       = 1;
                            while ($r1 = mysqli_fetch_array($hasil1)) {
                                $id         = $r1['id'];
                                $nim        = $r1['nim'];
                                $nama       = $r1['nama'];
                                $alamat     = $r1['alamat'];
                                $email      = $r1['email'];
                                $jurusan    = $r1['jurusan'];

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nim ?></td>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $alamat ?></td>
                                    <td scope="row"><?php echo $email ?></td>
                                    <td scope="row"><?php echo $jurusan ?></td>
                                    <td scope="row">
                                        <a href="tambah_mahasiswa.php?op=update&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Update</button></a>
                                        <a href="hapus_mahasiswa.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
    </div>

</body>

</html>

