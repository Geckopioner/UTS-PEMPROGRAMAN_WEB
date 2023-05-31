<!-- READ untuk menampilkan data -->
<div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Mahasiswa
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
                                        <a href="datamahasiswa.php?op=update&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Update</button></a>
                                        <a href="datamahasiswa.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>

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