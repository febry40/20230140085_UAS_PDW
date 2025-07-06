<?php
$pageTitle = 'Tambah Praktikum';
$activePage = 'modul'; // supaya nav aktif di sidebar
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $query = "INSERT INTO praktikum (nama, deskripsi) VALUES ('$nama', '$deskripsi')";
    mysqli_query($conn, $query);
    
    header("Location: index.php");
    exit;
}
?>
include '../asisten/templates/header.php';

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Praktikum</h2>
    <form method="post">
        <label class="block mb-2">Nama Praktikum</label>
        <input type="text" name="nama" required class="w-full border px-3 py-2 rounded mb-4">

        <label class="block mb-2">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border px-3 py-2 rounded mb-4"></textarea>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>

<?php include '../asisten/templates/footer.php'; ?>
