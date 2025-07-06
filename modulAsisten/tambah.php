<?php
include '../config.php';
$praktikum_id = $_GET['praktikum_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $file_name = '';

  if ($_FILES['file']['name']) {
    $file_name = time() . '_' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $file_name);
  }

  mysqli_query($conn, "INSERT INTO modul (praktikum_id, nama, deskripsi, file_materi) 
    VALUES ($praktikum_id, '$nama', '$deskripsi', '$file_name')");
  header("Location: index.php?praktikum_id=$praktikum_id");
}
?>

<h2>Tambah Modul</h2>
<form method="post" enctype="multipart/form-data">
  <label>Nama Modul:</label><br>
  <input type="text" name="nama" required><br>
  <label>Deskripsi:</label><br>
  <textarea name="deskripsi"></textarea><br>
  <label>Upload Materi (PDF/DOCX):</label><br>
  <input type="file" name="file"><br>
  <button type="submit">Simpan</button>
</form>
