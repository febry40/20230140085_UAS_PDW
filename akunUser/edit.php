<?php
$pageTitle = 'Kelola Akun';
$activePage = 'akunUser';
include '../config.php';

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = (int) $_GET['id'];

// Proses update data saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = $_POST['role'];

    // Validasi role
    if (!in_array($role, ['mahasiswa', 'asisten'])) {
        die("Role tidak valid.");
    }

    // Update user
    $update = mysqli_query($conn, "UPDATE users SET nama='$nama', email='$email', role='$role' WHERE id=$id");

    if ($update) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color: red;'>Gagal memperbarui data.</p>";
    }
}

// Ambil data user untuk ditampilkan di form
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));

if (!$data) {
    die("User tidak ditemukan.");
}

include '../asisten/templates/header.php';
?>

<h2 class="text-2xl font-bold mb-4">Edit Akun</h2>
<form method="post" class="space-y-4">
  <div>
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required class="border rounded px-3 py-1 w-full">
  </div>
  <div>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required class="border rounded px-3 py-1 w-full">
  </div>
  <div>
    <label>Role:</label><br>
    <select name="role" required class="border rounded px-3 py-1 w-full">
      <option value="mahasiswa" <?= $data['role'] === 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
      <option value="asisten" <?= $data['role'] === 'asisten' ? 'selected' : '' ?>>Asisten</option>
    </select>
  </div>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
</form>

