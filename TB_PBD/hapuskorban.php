<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];
$nik = $_GET['nik'];

$result = mysqli_query($conn, "DELETE FROM korban WHERE id_kebakaran='$id_kebakaran' AND nik = '$nik'");

header("Location:korban.php?id_kebakaran=$id_kebakaran");

?>