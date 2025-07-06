<?php
$pageTitle = 'Cari Praktikum';
$activePage = 'cari_praktikum';
include '../config.php';
include 'templates/header_mahasiswa.php';

$mahasiswa_id = $_SESSION['user_id'];

// Ambil semua praktikum
$query = "SELECT * FROM praktikum";
$praktikum = mysqli_query($conn, $query);

// Ambil praktikum yang sudah diikuti
$daftarSaya = mysqli_query($conn, "SELECT praktikum_id FROM praktikum_mahasiswa WHERE mahasiswa_id = $mahasiswa_id");
$sudahDiikuti = [];
while ($d = mysqli_fetch_assoc($daftarSaya)) {
  $sudahDiikuti[] = $d['praktikum_id'];
}
?>

<div class="max-w-4xl mx-auto bg-white p-6 mt-6 rounded shadow">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Katalog Praktikum</h2>
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
          <?php if (in_array($p['id'], $sudahDiikuti)) { ?>
            <span class="text-green-600 font-semibold">Sudah Terdaftar</span>
          <?php } else { ?>
            <form method="post" action="proses_daftar.php">
              <input type="hidden" name="praktikum_id" value="<?= $p['id'] ?>">
              <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                Daftar
              </button>
            </form>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'templates/footer_mahasiswa.php'; ?>
