<?php
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Redirect ke halaman login yang benar
header("Location: /SistemPengumpulanTugas-main/login.php");
exit;
?>
