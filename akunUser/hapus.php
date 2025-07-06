<?php
include '../config.php';

$id = (int) $_GET['id']; // cast ke int untuk keamanan dasar
mysqli_query($conn, "DELETE FROM users WHERE id = $id");

header("Location: index.php");
exit;
