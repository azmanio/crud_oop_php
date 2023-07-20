<?php

include('koneksi.php');
$db = new database();
$data_kategori = $db->tampilKategori();
$koneksi = new database();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kategori Obat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.html"><i><b>Klinik Sehat Kita</b></i></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="obat.php">Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kategori.php">Kategori</a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <h3 class="p-2" style="text-align: center;">
            Sistem Pengelolaan Stok Obat
        </h3>
    </div>
    <!-- Progress Table start -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_GET['pesan'])) {
                    $pesan = $_GET['pesan'];
                    echo "<div class='alert alert-success'> $pesan </div>";
                }
                if (isset($_GET['pesan'])) {
                    $pesan = $_GET['pesan'];
                    echo "<div class='alert alert-alert'> $pesan </div>";
                }
                ?>
                <!-- Button to Open the Modal -->
                <div class="text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        |+| Tambah Kategori
                    </button>
                </div>

                <div class="single-table">
                    <div class="table-responsive">
                        <table>
                            <td class="p-2">Pencarian</td>
                            <td style="width: 100%;"><input class="form-control m-2" id="myInput" type="text" placeholder="Search.."></td>
                        </table>
                        <table class="table table-hover progress-table text-center" id="dtable">
                            <thead class="text-uppercase">
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                <?php
                                $no = 1;
                                foreach ($data_kategori as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row["namaKategori"]; ?></td>
                                        <td>
                                            <a href="" class="text-secondary" data-toggle="modal" data-target="#myModalEdit<?php echo $row['idKategori']; ?>">
                                                <p class="fa fa-edit fa-2x"></p>
                                            </a>
                                            <a href="" class="text-danger" data-toggle="modal" data-target="#myModalHapus<?php echo $row['idKategori']; ?>">
                                                <p class="fa fa-trash fa-2x"></p>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- main content area end -->

                                    <!-- The Modal -->
                                    <div class="modal" id="myModalEdit<?php echo $row['idKategori']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data kategori</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="POST" action="kategori.php">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idKategori" value="<?php echo $row['idKategori']; ?>">

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kategori</label>
                                                                <input type="text" class="form-control" name="namaKategori" value="<?php echo $row['namaKategori']; ?>" placeholder="Masukkan Nama Kategori">
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success" name="ubah">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- awal modal hapus -->
                                    <div class="modal fade " id="myModalHapus<?php echo $row['idKategori']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Menghapus Data</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="kategori.php">
                                                    <input type="hidden" name="idKategori" value="<?= $row['idKategori'] ?>">

                                                    <div class="modal-body">
                                                        <h5 class="text-center">Apakah anda ingin menghapus data ini?
                                                            <br><span class="text-danger"><?= $row['namaKategori'] ?></span>
                                                        </h5>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhirmodal hapus -->
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Input Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <form action="kategori.php" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="namaKategori" placeholder="Input Nama Kategori" required>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['simpan'])) {

                //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas

                $hasil == $koneksi->tambahKategori($_POST['namaKategori']);
                if ($hasil) {
                    echo "<script>window.location.href='kategori.php';</script>";
                } else {
                    echo "<script>window.location.href='kategori.php';</script>";
                }
            }

            if (isset($_POST['ubah'])) {
                $koneksi->ubahKategori($_POST['idKategori'], $_POST['namaKategori']);
                if ($hasil) {
                    echo "<script>window.location.href='kategori.php';</script>";
                } else {
                    echo "<script>window.location.href='kategori.php';</script>";
                }
            }

            if (isset($_POST['hapus'])) {
                $hapus = $koneksi->hapusKategori($_POST['idKategori']);
                if ($hapus) {
                    echo "<script>window.location.href='kategori.php';</script>";
                } else {
                    echo "<script>window.location.href='kategori.php';</script>";
                }
            }

            ?>

            <!-- footer area start-->
            <footer class="fixed-bottom" style="position: fixed;height: 30px;bottom: 0;width: 100%; background-color: blue; opacity:0.5;">
                <p style="color: white; text-align: center;"> Azis Rahman Prasetio | 200511018 | Teknik Informatika | Universitas Muhammadiyah Cirebon</p>
            </footer>

            <script>
                $(document).ready(function() {
                    $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>
</body>

</html>