<?php
$pageTitle = "Detail Praktikum";
$activePage = "praktikum_saya";
include '../config.php'; // Ganti kalau kamu masih pakai koneksi.php
include 'templates/header_mahasiswa.php';

$mahasiswa_id = $_SESSION['user_id'];
$praktikum_id = $_GET['id'];

// Ambil info praktikum
$praktikum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM praktikum WHERE id = $praktikum_id"));

// Ambil semua modul dari praktikum ini
$modul = mysqli_query($conn, "SELECT * FROM modul WHERE praktikum_id = $praktikum_id");

// Ambil laporan mahasiswa
$laporan = [];
$res = mysqli_query($conn, "SELECT * FROM laporan WHERE mahasiswa_id = $mahasiswa_id AND praktikum_id = $praktikum_id");
while ($l = mysqli_fetch_assoc($res)) {
    $laporan[$l['modul_id']] = $l;
}
?>

<div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($praktikum['nama']) ?></h2>
  <p class="text-gray-600 mb-6"><?= htmlspecialchars($praktikum['deskripsi']) ?></p>

  <table class="min-w-full border text-sm">
    <thead class="bg-gray-200">
      <tr>
        <th class="border p-2">Modul</th>
        <th class="border p-2">Materi</th>
        <th class="border p-2">Laporan Saya</th>
        <th class="border p-2">Nilai</th>
        <th class="border p-2">Upload</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($m = mysqli_fetch_assoc($modul)) {
        $lap = $laporan[$m['id']] ?? null;
      ?>
      <tr>
        <td class="border p-2"><?= htmlspecialchars($m['nama']) ?></td>
        <td class="border p-2">
          <?php if ($m['file_materi']) { ?>
            <a href="../modul/upload/<?= $m['file_materi'] ?>" target="_blank" class="text-blue-600 underline">Download</a>
          <?php } else { echo "-"; } ?>
        </td>
        <td class="border p-2">
          <?php if ($lap) { ?>
            <a href="../laporan/upload/<?= $lap['file_laporan'] ?>" class="text-blue-500 underline" target="_blank">Lihat</a>
          <?php } else { echo "-"; } ?>
        </td>
        <td class="border p-2">
          <?= $lap['nilai'] ?? '-' ?><br>
          <small class="text-xs text-gray-500"><?= $lap['feedback'] ?? '' ?></small>
        </td>
        <td class="border p-2">
          <form method="post" action="upload_laporan.php" enctype="multipart/form-data">
            <input type="hidden" name="praktikum_id" value="<?= $praktikum_id ?>">
            <input type="hidden" name="modul_id" value="<?= $m['id'] ?>">
            <input type="file" name="file" class="text-sm">
            <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-sm mt-1">Upload</button>
          </form>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'templates/footer_mahasiswa.php'; ?>
