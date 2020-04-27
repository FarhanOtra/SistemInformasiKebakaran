<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];

if(isset($_POST['tambahkerugian'])){

  $id_kerugian = $_POST['id_kerugian'];
  $jumlah = $_POST['jumlah'];

  $result = mysqli_query($conn, "INSERT INTO detail_kerugian values ('$id_kebakaran','$id_kerugian',$jumlah)");

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
         <table>
			<form action="" method="POST">
				<tr>
					<h1>Tambah Data Kerugian</h1>
				</tr>
				<tr>
					<td>Jenis Kerugian</td>
					<td>
						<select name="id_kerugian" >

		                    <?php 

		                    $koderesult = mysqli_query($conn,"SELECT * FROM kerugian");
		                    while($kode = mysqli_fetch_assoc($koderesult))  : ;  ?>

		                         <option value="<?php echo $kode['id_kerugian'];?>"><?php echo $kode['jenis_kerugian'];?></option>

		                   <?php endwhile; ?>

	                 	</select>
					</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td><input type="text" name="jumlah" size="30"></td>
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="tambahkerugian" class="button submit"></td>
				</tr>
			</form>
		</table>
        </center>
        </div>
  </div>
  <div class="main">
      <table border="1" cellpadding="5" cellspacing="0" width="100%">
		<tr>
			<h1>Data Kerugian</h1>
		</tr>
		<tr bgcolor="#bf4040" style="color: white;">
			<th>Jenis Kerugian</th>
			<th>Jumlah</th>
			<th>Action</th>
		</tr>
			<?php 

                    $ambil = mysqli_query($conn,"SELECT kerugian.jenis_kerugian, detail_kerugian.jumlah, detail_kerugian.id_kerugian FROM kebakaran INNER JOIN detail_kerugian ON kebakaran.id_kebakaran=detail_kerugian.id_kebakaran INNER JOIN kerugian ON kerugian.id_kerugian=detail_kerugian.id_kerugian WHERE kebakaran.id_kebakaran='$id_kebakaran'");

                    while($data = mysqli_fetch_assoc($ambil)){

                     ?>
                    
                     <tr>
                      <td><?php echo $data['jenis_kerugian']; ?></td>
                      <td><?php echo $data['jumlah']; ?></td>
                      <td style="text-align: center;"><a href="hapuskerugian.php?id_kebakaran=<?php echo $id_kebakaran;?>&id_kerugian=<?php echo $data['id_kerugian']; ?>" onclick="return confirm('Yakin Ingin Menghapus Data Kerugian ?')"><button class="button hapus">Hapus</button></a></td>
                     </tr>

                <?php } ?>
		</table>
      <div align="center" style="margin-top: 50px;"><a href="penanganan.php?id_kebakaran=<?php echo $id_kebakaran; ?>" onclick="return confirm('Anda Yakin?')"><button class="button detail" style="font-size: 20px;">Simpan Data</button></a></div>
    </div>
  </div>

<div class="footer">
  <h5>Copyright Kelompok 6</h5>
</div>

</div>

</body>
</html>