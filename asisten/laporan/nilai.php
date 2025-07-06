<?php
include '../../config.php';
$id = $_GET['id'];

if (!is_numeric($id)) {
  die("ID tidak valid");
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT l.*, u.nama AS nama_mahasiswa, m.nama AS nama_pertemuan
FROM laporan l
JOIN users u ON l.mahasiswa_id = u.id
JOIN modul m ON l.modul_id = m.id
WHERE l.id = $id
"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nilai = intval($_POST['nilai']);
  $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
  mysqli_query($conn, "UPDATE laporan SET nilai=$nilai, feedback='$feedback' WHERE id=$id");
  header("Location: index.php");
  exit;
}
?>

<h2>Nilai Laporan</h2>
<p><strong>Mahasiswa:</strong> <?= $data['nama_mahasiswa'] ?></p>
<p><strong>Pertemuan:</strong> <?= $data['nama_pertemuan'] ?></p>
<p><strong>Laporan:</strong> <a href="upload/<?= $data['file_laporan'] ?>" target="_blank">Download File</a></p>

<form method="post">
  <label>Nilai (0-100):</label><br>
  <input type="number" name="nilai" value="<?= $data['nilai'] ?>" required><br><br>

  <label>Feedback:</label><br>
  <textarea name="feedback"><?= $data['feedback'] ?></textarea><br><br>

  <button type="submit">Simpan Nilai</button>
</form>
