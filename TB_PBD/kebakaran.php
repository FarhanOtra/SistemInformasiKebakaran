<?php 

include_once("koneksi.php");

if(isset($_POST['tambah'])){

  $id_kebakaran = $_POST['id_kebakaran'];
  $tanggal = $_POST['tanggal'];
  $waktu = $_POST['waktu'];
  $id_penyebab = $_POST['id_penyebab'];

  $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kebakaran WHERE id_kebakaran='$id_kebakaran'"));

  if($cek > 0){
      echo "<script>alert('ID Kebakaran Telah Digunakan');</script>";
  }else{
    $result = mysqli_query($conn, "INSERT INTO kebakaran values ('$id_kebakaran','$tanggal','$waktu','$id_penyebab')");
    header("Location:lokasi.php?id_kebakaran=$id_kebakaran");
  }

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Kebakaran</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h1>SISTEM INFORMASI KEBENCANAAN KEBAKARAN</h1>
  <h2>Kota Padang</h2>
</div>

<div class="navbar">
  <a href="index.php">Home</a>
  <a href="kebakaran.php">Tambah Data</a>
  <a href="cari.php">Pencarian</a>
</div>

<div class="container">
  <center>
  <table>
    <tr>
      <h1>Tambah Daftar Kebakaran</h1>
    </tr>
    <form method="POST">
      <tr>
        <td>ID Kebakaran</td>
        <td><input type="text" name="id_kebakaran" required=""></td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td><input type="date" name="tanggal" required=""></td>
      </tr>
      <tr>
        <td>Waktu</td>
        <td><input type="time" name="waktu" required=""></td>
      </tr>
      <tr>
        <td>Penyebab</td>
        <td>
          <select name="id_penyebab" required="">

                      <?php 

                      $koderesult = mysqli_query($conn,"SELECT * FROM penyebab");
                      while($kode = mysqli_fetch_assoc($koderesult))  : ;  ?>

                           <option value="<?php echo $kode['id_penyebab'];?>"><?php echo $kode['penyebab'];?></option>

                     <?php endwhile; ?>

          </select>
        </td>
      </tr>
      <tr></tr>
      <tr>
        <td colspan="2" style="text-align: center;"><input type="submit" name="tambah" value="Tambah" class="button submit"></td>
      </tr>
    </form>
  </table>
  </center>
</div>

</body>
</html>