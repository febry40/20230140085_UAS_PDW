<?php
include '../config.php';
$praktikum = mysqli_query($conn, "SELECT * FROM praktikum");
?>

<h1>Daftar Mata Praktikum</h1>
<a href="tambah.php">+ Tambah Praktikum</a>
<table border="1" cellpadding="10">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Deskripsi</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while($row = mysqli_fetch_assoc($praktikum)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama'] ?></td>
      <td><?= $row['deskripsi'] ?></td>
      <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
        <a href="../modulAsisten/index.php?praktikum_id=<?= $row['id'] ?>">Kelola Modul</a>
      </td>
      </td>
    </tr>
  <?php } ?>
</table>
