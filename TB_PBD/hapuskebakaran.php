<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];

$result = mysqli_query($conn, "DELETE FROM korban WHERE id_kebakaran='$id_kebakaran'");
$result = mysqli_query($conn, "DELETE FROM penanganan WHERE id_kebakaran='$id_kebakaran'");
$result = mysqli_query($conn, "DELETE FROM detail_kerugian WHERE id_kebakaran='$id_kebakaran'");
$result = mysqli_query($conn, "DELETE FROM detail_lokasi WHERE id_kebakaran='$id_kebakaran'");
$result = mysqli_query($conn, "DELETE FROM detail_kecamatan WHERE id_kebakaran='$id_kebakaran'");
$result = mysqli_query($conn, "DELETE FROM kebakaran WHERE id_kebakaran='$id_kebakaran'");

header("Location:index.php");

?>