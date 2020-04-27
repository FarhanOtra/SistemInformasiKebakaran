<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];

if(isset($_POST['tambahpenanganan'])){

  $id_penanganan = $_POST['id_penanganan'];
  $jumlah = $_POST['jumlah'];

  $result = mysqli_query($conn, "INSERT INTO penanganan values ('$id_kebakaran','$id_penanganan',$jumlah)");

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>SIK Kebakaran Kota Padang</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="core">

<div class="header">
  <h1>SISTEM INFORMASI KEBENCANAAN KEBAKARAN</h1>
  <h2>Kota Padang</h2>
</div>

<div class="navbar">
  <h1> </h1>
</div>

<div class="row">
  <div class="side">
    <div class="container">
        <center>
         <table >
			<form action="" method="POST">
				<tr>
					<h1>Tambah Penanganan</h1>
				</tr>
				<tr>
					<td>Jenis Penanganan</td>
					<td>
						<select name="id_penanganan" >

		                    <?php 

		                    $koderesult = mysqli_query($conn,"SELECT * FROM mobil");
		                    while($kode = mysqli_fetch_assoc($koderesult))  : ;  ?>

		                         <option value="<?php echo $kode['id_mobil'];?>"><?php echo $kode['jenis_mobil'];?></option>

		                   <?php endwhile; ?>

	                 	</select>
					</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td><input type="number" name="jumlah"> Unit</td>
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="tambahpenanganan" class="button submit"></td>
				</tr>
			</form>
		</table>
        </center>
        </div>
    </div>
  <div class="main">
      <table border="1" cellpadding="5" cellspacing="0" width="100%">
		<tr>
			<h1>Data Penanganan</h1>
		</tr>
		<tr bgcolor="#bf4040" style="color: white;">
			<th>Jenis Penanganan</th>
			<th>Jumlah</th>
			<th>Action</th>
		</tr>
			<?php 

                    $ambil = mysqli_query($conn,"SELECT mobil.jenis_mobil, penanganan.jumlah, mobil.id_mobil FROM penanganan,mobil WHERE id_kebakaran='$id_kebakaran' AND penanganan.id_mobil=mobil.id_mobil");

                    while($data = mysqli_fetch_assoc($ambil)){

                     ?>
                    
                     <tr>
                      <td><?php echo $data['jenis_mobil']; ?></td>
                      <td><?php echo $data['jumlah']; ?></td>
                      <td style="text-align: center;"><a href="hapuspenanganan.php?id_kebakaran=<?php echo $id_kebakaran;?>&id_mobil=<?php echo $data['id_mobil']; ?>" onclick="return confirm('Yakin Ingin Menghapus Data Penanganan ?')"><button class="button hapus">Hapus</button></a></td>
                     </tr>

            <?php } ?>
		</table>
      <div align="center" style="margin-top: 50px;"><a href="berhasil.php" onclick="return confirm('Anda Yakin?')"><button class="button detail" style="font-size: 20px;">Simpan Data</button></a></div>
    </div>
  </div>

<div class="footer">
  <h5>Copyright Kelompok 6</h5>
</div>

</div>

</body>
</html>