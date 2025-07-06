<?php
include '../config.php';
$id = $_GET['id'];
$praktikum_id = $_GET['praktikum_id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM modul WHERE id=$id"));
if ($data['file_materi'] && file_exists("upload/" . $data['file_materi'])) {
  unlink("upload/" . $data['file_materi']);
}
mysqli_query($conn, "DELETE FROM modul WHERE id=$id");
header("Location: index.php?praktikum_id=$praktikum_id");
