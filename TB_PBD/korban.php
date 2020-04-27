<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];

if(isset($_POST['tambahkorban'])){

  $nik = $_POST['nik'];
  $id_kondisi = $_POST['id_kondisi'];

  $ceknik = mysqli_query($conn,"SELECT * FROM penduduk WHERE nik='$nik'");
  $cek = mysqli_num_rows($ceknik);

  if($cek > 0){
    $result = mysqli_query($conn, "INSERT INTO korban values ('$id_kebakaran','$nik','$id_kondisi')");
  }else{
    echo "<script>alert('NIK tidak Valid');</script>";
  }
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
                <h1>Tambah Data Korban</h1>
              </tr>
              <tr>
                <td>NIK</td>
                <td><input type="number" name="nik"></td>
              </tr>
              <tr>
                <td>Kondisi</td>
                <td>
                  <select name="id_kondisi">

                              <?php 

                              $koderesult = mysqli_query($conn,"SELECT * FROM kondisi_korban");
                              while($kode = mysqli_fetch_assoc($koderesult))  : ;  ?>

                                   <option value="<?php echo $kode['id_kondisi'];?>"><?php echo $kode['kondisi_korban'];?></option>

                             <?php endwhile; ?>

                          </select>
                </td>
              </tr>
              <tr></tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="tambahkorban" class="button submit" value="Tambah Data"></td>
              </tr>
            </form>
          </table>
        </center>
        </div>
    </div>
  <div class="main">
      <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <tr>
          <h1>Data Korban</h1>
        </tr>
        <tr bgcolor="#bf4040" style="color: white;">
          <th>NIK</th>
          <th>Nama</th>
          <th>Umur</th>
          <th>Pekerjaan</th>
          <th>Keterangan</th>
          <th>Kondisi Korban</th>
          <th>Action</th>
        </tr>
                    <?php 

                        $ambil = mysqli_query($conn,"SELECT kebakaran.id_kebakaran, penduduk.nik, penduduk.nama, penduduk.umur, penduduk.pekerjaan, penduduk.keterangan, kondisi_korban.kondisi_korban FROM kebakaran INNER JOIN korban ON kebakaran.id_kebakaran=korban.id_kebakaran INNER JOIN penduduk ON korban.nik=penduduk.nik INNER JOIN kondisi_korban ON kondisi_korban.id_kondisi=korban.id_kondisi WHERE Kebakaran.id_kebakaran='$id_kebakaran'");

                        while($data = mysqli_fetch_assoc($ambil)){

                         ?>
                        
                         <tr>
                          <td><?php echo $data['nik']; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['umur']; ?></td>
                          <td><?php echo $data['pekerjaan']; ?></td>
                          <td><?php echo $data['keterangan']; ?></td>
                          <td><?php echo $data['kondisi_korban']; ?></td>
                          <td style="text-align: center;">
                            <a href="hapuskorban.php?id_kebakaran=<?php echo $id_kebakaran;?>&nik=<?php echo $data['nik']; ?>" onclick="return confirm('Yakin Ingin Menghapus Data Korban ?')"><button class="button hapus">Hapus</button></a>
                          </td>
                         </tr>

                    <?php } ?>
      </table>
      <div align="center" style="margin-top: 50px;"><a href="kerugian.php?id_kebakaran=<?php echo $id_kebakaran; ?>" onclick="return confirm('Anda Yakin?')"><button class="button detail" style="font-size: 20px;">Simpan Data</button></a></div>
    </div>
  </div>

<div class="footer">
  <h5>Copyright Kelompok 6</h5>
</div>

</div>

</body>
</html>