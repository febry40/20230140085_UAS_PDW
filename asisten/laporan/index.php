<?php
$pageTitle = 'Laporan Masuk';
$activePage = 'laporan';
include '../templates/header.php';
include '../../config.php';

// Ambil data semua laporan
$query = "
SELECT l.*, u.nama AS nama_mahasiswa, p.nama AS nama_praktikum, m.nama AS nama_modul
FROM laporan l
JOIN users u ON l.mahasiswa_id = u.id
JOIN praktikum p ON l.praktikum_id = p.id
JOIN modul m ON l.modul_id = m.id
ORDER BY l.created_at DESC
";
$data = mysqli_query($conn, $query);
?>

<div class="bg-white p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-bold mb-4">Daftar Laporan Masuk</h2>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border">Mahasiswa</th>
          <th class="px-4 py-2 border">Praktikum</th>
          <th class="px-4 py-2 border">Modul</th>
          <th class="px-4 py-2 border">File</th>
          <th class="px-4 py-2 border">Nilai</th>
          <th class="px-4 py-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr class="text-center">
          <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_mahasiswa']) ?></td>
          <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_praktikum']) ?></td>
          <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_modul']) ?></td>
          <td class="px-4 py-2 border">
            <a href="upload/<?= urlencode($row['file_laporan']) ?>" target="_blank" class="text-blue-600 hover:underline">Download</a>
          </td>
          <td class="px-4 py-2 border">
            <?= $row['nilai'] !== null ? $row['nilai'] : '-' ?>
          </td>
          <td class="px-4 py-2 border">
            <a href="nilai.php?id=<?= $row['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Nilai</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include '../templates/footer.php'; ?>
