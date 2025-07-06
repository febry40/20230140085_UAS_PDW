<?php
$pageTitle = 'Kelola Akun';
$activePage = 'akunUser';
include '../asisten/templates/header.php';
include '../config.php';

$data = mysqli_query($conn, "SELECT * FROM users");
?>

<h2 class="text-2xl font-bold mb-4">Daftar Akun Pengguna</h2>
<a href="tambah.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block mb-4">+ Tambah Akun</a>

<table border="1" cellpadding="10">
  <tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th>Aksi</th>
  </tr>
  <?php while ($u = mysqli_fetch_assoc($data)) { ?>
  <tr>
    <td><?= $u['nama'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['role'] ?></td>
    <td>
      <a href="edit.php?id=<?= $u['id'] ?>">Edit</a> |
      <a href="hapus.php?id=<?= $u['id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>

<?php include '../asisten/templates/footer.php'; ?>