<?php
include '../config.php';
$id = $_GET['id'];
$modul = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM modul WHERE id=$id"));
$praktikum_id = $modul['praktikum_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $file_name = $modul['file_materi'];

  if ($_FILES['file']['name']) {
    if ($file_name && file_exists("upload/$file_name")) unlink("upload/$file_name");
    $file_name = time() . '_' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $file_name);
  }

  mysqli_query($conn, "UPDATE modul SET nama='$nama', deskripsi='$deskripsi', file_materi='$file_name' WHERE id=$id");
  header("Location: index.php?praktikum_id=$praktikum_id");
}
?>

<h2>Edit Modul</h2>
<form method="post" enctype="multipart/form-data">
  <label>Nama Modul:</label><br>
  <input type="text" name="nama" value="<?= $modul['nama'] ?>" required><br>
  <label>Deskripsi:</label><br>
  <textarea name="deskripsi"><?= $modul['deskripsi'] ?></textarea><br>
  <label>Ganti File Materi (kosongkan jika tidak diubah):</label><br>
  <input type="file" name="file"><br>
  <button type="submit">Update</button>
</form>
