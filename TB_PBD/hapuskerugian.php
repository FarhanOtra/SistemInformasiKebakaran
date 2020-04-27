<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];
$id_kerugian = $_GET['id_kerugian'];

$result = mysqli_query($conn, "DELETE FROM detail_kerugian WHERE id_kebakaran = '$id_kebakaran' AND id_kerugian = '$id_kerugian'");

header("Location:kerugian.php?id_kebakaran=$id_kebakaran");

?>