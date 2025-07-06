<?php
session_start();
include '../config.php';

$mahasiswa_id = $_SESSION['user_id'];
$praktikum_id = (int) $_POST['praktikum_id'];
$modul_id = (int) $_POST['modul_id']; // ganti dari pertemuan_id

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    header("Location: detail_praktikum.php?id=$praktikum_id");
    exit;
}

$upload_dir = '../laporan/upload/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // buat folder kalau belum ada
}

$file_name = time() . '_' . basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $file_name);

// Validasi foreign key: modul_id harus ada
$cekModul = mysqli_query($conn, "SELECT id FROM modul WHERE id = $modul_id");
if (mysqli_num_rows($cekModul) == 0) {
    die("Modul dengan ID $modul_id tidak ditemukan.");
}

$cek = mysqli_query($conn, "SELECT * FROM laporan WHERE mahasiswa_id=$mahasiswa_id AND modul_id=$modul_id");

if (mysqli_num_rows($cek) > 0) {
    mysqli_query($conn, "UPDATE laporan SET file_laporan='$file_name', created_at = CURRENT_TIMESTAMP WHERE mahasiswa_id=$mahasiswa_id AND modul_id=$modul_id");
} else {
    mysqli_query($conn, "INSERT INTO laporan (mahasiswa_id, praktikum_id, modul_id, file_laporan) 
                         VALUES ($mahasiswa_id, $praktikum_id, $modul_id, '$file_name')");
}

header("Location: detail_praktikum.php?id=$praktikum_id");
exit;
?>
