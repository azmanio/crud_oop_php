<?php 
class database{

	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "crud_pwl";
	var $koneksi = "";
	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi Database Gagal : " . mysqli_connect_error();
		}
	}

	function tampilObat()
	{
		$data = mysqli_query($this->koneksi,"SELECT * FROM obat
		INNER JOIN kategori
		ON kategori.idKategori = obat.idKategori");
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return $hasil;
	}

	function tambahObat($idKategori, $namaObat, $jumlahStok, $hargaBeli, $hargaJual)
	{
		mysqli_query($this->koneksi,"INSERT INTO obat VALUES ('','$idKategori','$namaObat','$jumlahStok','$hargaBeli','$hargaJual')");
	}

	function getAllObat($idObat)
	{
		$query = mysqli_query($this->koneksi, "SELECT * FROM obat WHERE idObat='$idObat'");
		return $query->fetch_array();
	}

	function ubahObat($idObat, $idKategori, $namaObat, $jumlahStok, $hargaBeli, $hargaJual)
	{
		$query = mysqli_query($this->koneksi,"UPDATE obat SET idKategori='$idKategori', namaObat='$namaObat',jumlahStok='$jumlahStok', hargaBeli='$hargaBeli', hargaJual='$hargaJual' WHERE idObat='$idObat'");
	}

	function hapusObat($idObat)
	{
		$query = mysqli_query($this->koneksi, "DELETE FROM obat WHERE idObat='$idObat'");
	}

	//kategori
	function tampilKategori()
	{
		$data = mysqli_query($this->koneksi, "SELECT * FROM kategori");
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return $hasil;
	}

	function tambahKategori($namaKategori)
	{
		mysqli_query($this->koneksi,"INSERT INTO kategori VALUES ('','$namaKategori')");
	}
	function getAllKategori($idKategori)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM kategori WHERE idKategori='$idKategori'");
		return $query->fetch_array();
	}

	function ubahKategori($idKategori,$namaKategori)
	{
		$query = mysqli_query($this->koneksi,"UPDATE kategori SET namaKategori='$namaKategori'  WHERE idKategori='$idKategori'");
	}

	function hapusKategori($idKategori)
	{
		$query = mysqli_query($this->koneksi,"DELETE FROM kategori WHERE idKategori='$idKategori'");
		return $query;
	}


}
?>