<?php
session_start();
include '../config.php';

$mahasiswa_id = $_SESSION['user_id'];
$praktikum_id = $_POST['praktikum_id'];

// Cek apakah sudah pernah daftar
$cek = mysqli_query($conn, "SELECT * FROM praktikum_mahasiswa WHERE mahasiswa_id=$mahasiswa_id AND praktikum_id=$praktikum_id");
if (mysqli_num_rows($cek) == 0) {
  mysqli_query($conn, "INSERT INTO praktikum_mahasiswa (mahasiswa_id, praktikum_id) VALUES ($mahasiswa_id, $praktikum_id)");
}

header('Location: praktikum_saya.php');
exit;
