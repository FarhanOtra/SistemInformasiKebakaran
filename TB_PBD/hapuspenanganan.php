<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];
$id_mobil = $_GET['id_mobil'];

$result = mysqli_query($conn, "DELETE FROM penanganan WHERE id_kebakaran = '$id_kebakaran' AND id_mobil = '$id_mobil'");

header("Location:penanganan.php?id_kebakaran=$id_kebakaran");

?>