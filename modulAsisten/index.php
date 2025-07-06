<?php
include '../config.php';
echo "Database aktif: " . $conn->query("SELECT DATABASE()")->fetch_row()[0] . "<br>";

// ✅ Validasi praktikum_id dulu
if (!isset($_GET['praktikum_id']) || !is_numeric($_GET['praktikum_id'])) {
    echo "<h2 style='color: red;'>Praktikum tidak ditemukan atau belum dipilih.</h2>";
    exit;
}

$praktikum_id = $_GET['praktikum_id'];

// ✅ Ambil data praktikum dari database
echo "praktikum_id dari URL = " . $praktikum_id . "<br>";
$stmt = $conn->prepare("SELECT * FROM praktikum WHERE id = ?");
$stmt->bind_param("i", $praktikum_id);
$stmt->execute();
$result = $stmt->get_result();
$praktikum = $result->fetch_assoc();


if (!$praktikum) {
    echo "<h2 style='color: red;'>Praktikum dengan ID $praktikum_id tidak ditemukan.</h2>";
    exit;
}


if (!$praktikum) {
    echo "<h2 style='color: red;'>Praktikum dengan ID $praktikum_id tidak ditemukan.</h2>";
    exit;
}

$modul = mysqli_query($conn, "SELECT * FROM modul WHERE praktikum_id=$praktikum_id");
?>

<h2>Modul untuk Praktikum: <?= $praktikum['nama'] ?></h2>
<a href="tambah.php?praktikum_id=<?= $praktikum_id ?>">+ Tambah Modul</a>
<table border="1" cellpadding="10">
  <tr>
    <th>Nama</th>
    <th>Deskripsi</th>
    <th>File Materi</th>
    <th>Aksi</th>
  </tr>
  <?php while ($m = mysqli_fetch_assoc($modul)) { ?>
  <tr>
    <td><?= $m['nama'] ?></td>
    <td><?= $m['deskripsi'] ?></td>
    <td>
      <?php if ($m['file_materi']) { ?>
        <a href="./upload/<?= $m['file_materi'] ?>" target="_blank">Download</a>
      <?php } else { echo '-'; } ?>
    </td>
    <td>
      <a href="edit.php?id=<?= $m['id'] ?>">Edit</a> |
      <a href="hapus.php?id=<?= $m['id'] ?>&praktikum_id=<?= $praktikum_id ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>
