<?php 

  include_once("koneksi.php");

  $id_kebakaran = $_GET['id_kebakaran'];

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

<div class="header">
  <h1>SISTEM INFORMASI KEBENCANAAN KEBAKARAN</h1>
  <h2>Kota Padang</h2>
</div>

<div class="navbar">
  <a href="index.php">Halaman Utama</a href="index.php">
</div>

<div class="row_detail">
  <div class="tb_detail" style="width: 100%">
    <center>
    <table border="1" cellpadding="5" cellspacing="0" width="60%">
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
        </tr>
                    <?php 

                        $ambil = mysqli_query($conn,"SELECT kebakaran.id_kebakaran, penduduk.nik, penduduk.nama, penduduk.umur, penduduk.pekerjaan, penduduk.keterangan, kondisi_korban.kondisi_korban FROM kebakaran INNER JOIN korban ON kebakaran.id_kebakaran=korban.id_kebakaran INNER JOIN penduduk ON korban.nik=penduduk.nik INNER JOIN kondisi_korban ON kondisi_korban.id_kondisi=korban.id_kondisi WHERE kebakaran.id_kebakaran='$id_kebakaran'");
                        $jumlah = mysqli_num_rows($ambil);

                        while($data = mysqli_fetch_assoc($ambil)){

                         ?>
                        
                         <tr>
                          <td><?php echo $data['nik']; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['umur']; ?></td>
                          <td><?php echo $data['pekerjaan']; ?></td>
                          <td><?php echo $data['keterangan']; ?></td>
                          <td><?php echo $data['kondisi_korban']; ?></td>
                         </tr>

                    <?php } ?>
          <tr>
            <td colspan="6">Jumlah Korban : <?php echo $jumlah; ?></td>
          </tr>
      </table>
      </center>
    </div>

    <div class="tb_detail" style="width: 100%">
        <center>
            <table border="1" cellpadding="5" cellspacing="0" width="60%">
            <tr>
              <h1>Data Kerugian</h1>
            </tr>
            <tr bgcolor="#bf4040" style="color: white;">
              <th>Jenis Kerugian</th>
              <th>Jumlah</th>
            </tr>
              <?php         
                            $jumlah = 0;
                            $ambil = mysqli_query($conn,"SELECT kerugian.jenis_kerugian, detail_kerugian.jumlah, detail_kerugian.id_kerugian FROM kebakaran INNER JOIN detail_kerugian ON kebakaran.id_kebakaran=detail_kerugian.id_kebakaran INNER JOIN kerugian ON kerugian.id_kerugian=detail_kerugian.id_kerugian WHERE kebakaran.id_kebakaran='$id_kebakaran'");

                            while($data = mysqli_fetch_assoc($ambil)){
                              $jumlah = $jumlah + $data['jumlah'];
                             ?>
                            
                             <tr>
                              <td><?php echo $data['jenis_kerugian']; ?></td>
                              <td><?php echo 'Rp.'.number_format($data['jumlah'], 0, '', '.');?></td>
                             </tr>

              <?php } ?>
            <tr>
              <td style="text-align: right">Total</td>
              <td><?php echo 'Rp.'.number_format($jumlah, 0, '', '.');?></td>
            </tr>
            </table>
        </center>
    </div>

    <div class="tb_detail" style="width: 100%">
        <center>
            <table border="1" cellpadding="5" cellspacing="0" width="60%">
            <tr>
              <h1>Data Penanganan</h1>
            </tr>
            <tr bgcolor="#bf4040" style="color: white;">
              <th>Jenis Penanganan</th>
              <th>Jumlah</th>
            </tr>
              <?php 
                            $jumlah = 0;
                            $ambil = mysqli_query($conn,"SELECT mobil.jenis_mobil, penanganan.jumlah, mobil.id_mobil FROM penanganan,mobil WHERE id_kebakaran='$id_kebakaran' AND penanganan.id_mobil=mobil.id_mobil");

                            while($data = mysqli_fetch_assoc($ambil)){
                              $jumlah = $jumlah + $data['jumlah'];
                             ?>
                            
                             <tr>
                              <td><?php echo $data['jenis_mobil']; ?></td>
                              <td><?php echo $data['jumlah']; ?></td>
                             </tr>

                    <?php } ?>
            <tr>
              <td style="text-align: right;">Total</td>
              <td><?php echo $jumlah; ?></td>
            </tr>
            </table>
        </center>
    </div>
</div>
<br><br>
</body>
</html>