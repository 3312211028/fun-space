<?php
include 'koneksi.php';
$nip = $_POST['nip'];
$tgl = $_POST['tanggal'];
$telepon = $_POST['telepon'];
$nominal = $_POST['nominal'];
$jenis = $_POST['jenis_bantuan'];
$dp = $_POST['deskripsi_pengajuan'];
$file = $_FILES['bukti_pengajuan']['name'];
$status = $_POST['status'];
$ukuran_file = $_FILES['bukti_pengajuan']['size'];
$x = explode('.', $file);
$ekstensi = strtolower(end($x));
$ekstensi_diperbolehkan = array('png','heif','jpg','jpeg');
$tmp_file = $_FILES['bukti_pengajuan']['tmp_name'];
$path = "dokumen/pengajuan/".$file;
//tambahakan kode ini 
if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
if ($ukuran_file<=10000000) {
if (move_uploaded_file($tmp_file, "$path")) {
//echo "Berhasil Upload Gambar";
$sql=mysqli_query($koneksi, "INSERT INTO pengajuan VALUES('','$nip','$tgl','$telepon','$nominal','$jenis','$dp','$file','Belum Dikonfirmasi')");
if ($sql) {
header("Location:status.php");
}else{
echo "Terjadi Kesalahan Upload";
}
}//jika gambar gagal di upload
}//jika ukuran lebih besar dari 10 MB
}//jika tipe file bukan PNG,HEIF,JPG,JPEG
else{
echo " ekstensi salah";
}
?>