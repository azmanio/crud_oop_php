<?php
include('koneksi.php');
$db = new database();
$data_barang = $db->tampilObat();
$koneksi = new database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Data Obat</title>
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
		<a class="navbar-brand" href="index.html"><i><b>Klinik Sehat Kita</i></b></a>

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="obat.php">Obat</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="kategori.php">Kategori</a>
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
				if (isset($_GET['pesen'])) {
					$pesan = $_GET['pesan'];
					echo "<div class='alert alert-alert'> $pesan </div>";
				}
				?>
				<!-- Button to Open the Modal -->
				<div class="text-right">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
						|+| Tambah Obat
					</button>
				</div>
			</div>
			<div class="single-table">
				<div class="table-responsive">
					<table>
						<td class="p-2">Pencarian</td>
						<td style="width: 100%;"><input class="form-control m-2" id="myInput" type="text" placeholder="Search..."></td>
					</table>
					<table class="table table-hover progress-table text-center" id="dtable">
						<thead class="text-uppercase">
							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Kategori Obat</th>
								<th>Stok</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody id="myTable">
							<?php
							$no = 1;
							foreach ($data_barang as $row) {
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $row['namaObat']; ?></td>
									<td><?php echo $row['namaKategori']; ?></td>
									<td><?php echo $row['jumlahStok']; ?></td>
									<td><?php echo $row['hargaBeli']; ?></td>
									<td><?php echo $row['hargaJual']; ?></td>

									<td class="text-center">
										<a href="" class="text-secondary" data-toggle="modal" data-target="#myModalEdit<?php echo $row['idObat']; ?>">
											<p class="fa fa-edit fa-2x"></p>
										</a>
										<a href="" class="text-danger" data-toggle="modal" data-target="#myModalHapus<?php echo $row['idObat']; ?>">
											<p class="fa fa-trash fa-2x"></p>
										</a>
									</td>
								</tr>
								<!-- main content area end -->

								<!-- The Modal -->
								<div class="modal" id="myModalEdit<?php echo $row['idObat']; ?>">
									<div class="modal-dialog">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header">
												<h4 class="modal-title">Edit Data Obat</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>

											<!-- Modal body -->
											<form method="POST" action="obat.php">
												<div class="modal-body">
													<input type="hidden" name="idObat" value="<?php echo $row['idObat']; ?>">
													<div class="modal-body">
														<div class="mb-3">
															<label class="form-label">Nama Obat</label>
															<input type="text" class="form-control" name="namaObat" value="<?php echo $row['namaObat']; ?>" placeholder="Masukkan Nama Obat">
														</div>
														<div class="mb-3">
															<label class="form-label">Kategori Obat</label>
															<select class="form-control" name="idKategori">
																<option value="">Tolong Pilih Kategori</option>
																<?php
																$select = $row['idKategori'];
																$result_cat = $koneksi->tampilKategori();
																foreach ($result_cat as $result) : ?>
																	<option value="<?php echo $result['idKategori']; ?>
															" <?php
																	if ($result['idKategori'] == $select) {
																		echo 'selected';
																	}
																?>>
																		<?php echo $result['namaKategori']; ?></option>

																<?php endforeach; ?>
															</select>
														</div>

														<div class="mb-3">
															<label class="form-label">Stok</label>
															<input type="text" class="form-control" name="jumlahStok" value="<?php echo $row['jumlahStok']; ?>" placeholder="Masukkan Jumlah Stok">
														</div>

														<div class="mb-3">
															<label class="form-label">Harga Beli</label>
															<input type="text" class="form-control" name="hargaBeli" value="<?php echo $row['hargaBeli']; ?>" placeholder="Masukkan Harga Beli">
														</div>

														<div class="mb-3">
															<label class="form-label">Harga Jual</label>
															<input type="text" class="form-control" name="hargaJual" value="<?php echo $row['hargaJual']; ?>" placeholder="Masukkan Harga Jual">
														</div>
													</div>
													<!-- Modal footer -->
													<div class="modal-footer">
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-success" name="update">Simpan</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!-- awal modal hapus -->
								<div class="modal fade " id="myModalHapus<?php echo $row['idObat']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Menghapus Data</h3>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<form method="POST" action="obat.php">
												<input type="hidden" name="idObat" value="<?= $row['idObat'] ?>">

												<div class="modal-body">

													<h5 class="text-center">Apakah anda ingin menghapus data ini ?
														<br><span class="text-danger"><?= $row['namaObat'] ?></span>
													</h5>

												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-light border border-dark" data-dismiss="modal">Batal</button>
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
				<form action="obat.php" method="POST">
					<div class="modal-body">

						<div class="mb-3">
							<label class="form-label">Nama Obat</label>
							<input type="text" class="form-control" name="namaObat" placeholder="Masukkan Nama Obat">
						</div>
						<div class="mb-3">
							<label class="form-label">Kategori Obat</label>
							<select class="form-control" name="idKategori">
								<option value="">Pilih Kategori</option>
								<?php
								$acc = $db->tampilKategori();
								foreach ($acc as $opt) {
								?>
									<option value="<?= $opt['idKategori'] ?>"><?php echo $opt['namaKategori']; ?> </option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="mb-3">
							<label class="form-label">Stok</label>
							<input type="text" class="form-control" name="jumlahStok" placeholder="Masukkan Jumlah Stok">
						</div>

						<div class="mb-3">
							<label class="form-label">Harga Beli</label>
							<input type="text" class="form-control" name="hargaBeli" placeholder="Masukkan Harga Beli ">
						</div>
						<div class="mb-3">
							<label class="form-label">Harga Jual</label>
							<input type="text" class="form-control" name="hargaJual" placeholder="Masukkan Harga Jual ">
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
		$hasil == $koneksi->tambahObat($_POST['idKategori'], $_POST['namaObat'], $_POST['jumlahStok'], $_POST['hargaBeli'], $_POST['hargaJual']);
		if ($hasil) {
			echo "<script>window.location.href='obat.php';</script>";
		} else {
			echo "<script>window.location.href='obat.php';</script>";
		}
	}

	if (isset($_POST['update'])) {

		//Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
		$hasil == $koneksi->ubahObat($_POST['idObat'], $_POST['idKategori'], $_POST['namaObat'], $_POST['jumlahStok'], $_POST['hargaBeli'], $_POST['hargaJual']);
		if ($hasil) {
			echo "<script>window.location.href='obat.php';</script>";
		} else {
			echo "<script>window.location.href='obat.php';</script>";
		}
	}

	if (isset($_POST['hapus'])) {
		$hapus == $koneksi->hapusObat($_POST['idObat']);
		if ($hapus) {
			echo "<script>window.location.href='obat.php';</script>";
		} else {
			echo "<script>window.location.href='obat.php';</script>";
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