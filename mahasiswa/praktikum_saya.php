<?php
$pageTitle = 'Praktikum Saya';
$activePage = 'praktikum_saya';
include '../config.php';
include 'templates/header_mahasiswa.php';

$mahasiswa_id = $_SESSION['user_id'];

$query = "
SELECT p.id, p.nama, p.deskripsi
FROM praktikum p
JOIN praktikum_mahasiswa pm ON p.id = pm.praktikum_id
WHERE pm.mahasiswa_id = $mahasiswa_id
";
$praktikum = mysqli_query($conn, $query);
?>

<div class="max-w-4xl mx-auto bg-white p-6 mt-6 rounded shadow">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Praktikum Saya</h2>
  <table class="min-w-full border text-sm">
    <thead>
      <tr class="bg-gray-200">
        <th class="border p-2">Nama Praktikum</th>
        <th class="border p-2">Deskripsi</th>
        <th class="border p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($p = mysqli_fetch_assoc($praktikum)) { ?>
      <tr>
        <td class="border p-2"><?= $p['nama'] ?></td>
        <td class="border p-2"><?= $p['deskripsi'] ?></td>
        <td class="border p-2">
          <a href="detail_praktikum.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:underline">Lihat Detail</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'templates/footer_mahasiswa.php'; ?>
