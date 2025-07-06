<?php
$pageTitle = 'Edit Praktikum';
$activePage = 'modul';
include '../config.php';

// Validasi ID dulu sebelum query
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<p class='text-red-500'>ID tidak valid</p>");
}

$id = $_GET['id'];

// Ambil data untuk form
$praktikum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM praktikum WHERE id = $id"));
if (!$praktikum) {
    die("<p class='text-red-500'>Praktikum tidak ditemukan</p>");
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    mysqli_query($conn, "UPDATE praktikum SET nama='$nama', deskripsi='$deskripsi' WHERE id = $id");

    header("Location: index.php");
    exit;
}

include '../asisten/templates/header.php';
?>

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Praktikum</h2>
    <form method="post">
        <label class="block mb-2">Nama Praktikum</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($praktikum['nama']) ?>" required class="w-full border px-3 py-2 rounded mb-4">

        <label class="block mb-2">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border px-3 py-2 rounded mb-4"><?= htmlspecialchars($praktikum['deskripsi']) ?></textarea>

        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
    </form>
</div>

<?php include '../asisten/templates/footer.php'; ?>
