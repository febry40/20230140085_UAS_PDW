<?php
$pageTitle = 'Kelola Akun';
$activePage = 'akunUser';
include '../config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];

  // Cek apakah email sudah ada
  $cek = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Email sudah digunakan. Silakan pakai email lain.";
  } else {
    // Jalankan INSERT kalau email belum terdaftar
    mysqli_query($conn, "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')");
    header("Location: index.php");
    exit;
  }
}

include '../asisten/templates/header.php';
?>

<h2 class="text-2xl font-bold mb-4">Tambah Akun</h2>

<?php if (!empty($error)) : ?>
  <p class="text-red-500 mb-4"><?= $error ?></p>
<?php endif; ?>

<form method="post" class="space-y-4">
  <div>
    <label>Nama:</label><br>
    <input type="text" name="nama" required class="border rounded px-3 py-1 w-full">
  </div>
  <div>
    <label>Email:</label><br>
    <input type="email" name="email" required class="border rounded px-3 py-1 w-full">
  </div>
  <div>
    <label>Password:</label><br>
    <input type="password" name="password" required class="border rounded px-3 py-1 w-full">
  </div>
  <div>
    <label>Role:</label><br>
    <select name="role" required class="border rounded px-3 py-1 w-full">
      <option value="mahasiswa">Mahasiswa</option>
      <option value="asisten">Asisten</option>
    </select>
  </div>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>

<?php include '../asisten/templates/footer.php'; ?>
