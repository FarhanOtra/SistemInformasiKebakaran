<?php 

include_once("koneksi.php");

if(isset($_POST['caridata'])){
	$column  = $_POST['column'];
	$cari  = $_POST['cari'];
}else{
	$column  = 0;
	$cari  = 0;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>SIK Kebakaran Kota Padang</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANIx4N48kL_YEfp-fVeWmJ_3MSItIP8eI"></script>
  <script>
      function initialize() {
        var propertiPeta = {
          center:new google.maps.LatLng( -0.913548, 100.4626),
          zoom:9,
          mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        peta.data.loadGeoJson('data.php');

        peta.data.setStyle({
          fillColor: 'green',
          strokeWeight: 1
        });
  
      <?php
          
          $query = $conn->query("SELECT kebakaran.id_kebakaran, kebakaran.tanggal, kebakaran.waktu, penyebab.penyebab, lokasi.id_lokasi, lokasi.latitude, lokasi.longitude, kecamatan.nama_kecamatan, detail_lokasi.kejadian FROM kebakaran JOIN detail_lokasi ON kebakaran.id_kebakaran=detail_lokasi.id_kebakaran JOIN lokasi ON detail_lokasi.id_lokasi = lokasi.id_lokasi JOIN penyebab ON penyebab.id_penyebab=kebakaran.id_penyebab JOIN detail_kecamatan ON detail_kecamatan.id_kebakaran=kebakaran.id_kebakaran JOIN kecamatan ON kecamatan.id_kecamatan=detail_kecamatan.id_kecamatan WHERE $column LIKE '%$cari%'");
          while ($row = $query->fetch_assoc()) {
            $id_lokasi = $row["id_lokasi"];
            $lat  = $row["latitude"];
            $long = $row["longitude"];
            $kejadian = $row["kejadian"];
            echo "addMarker($lat, $long, '$id_lokasi', '$kejadian');\n";
          }
      ?> 

    function addMarker(lat, long, id_lokasi, kejadian){
      var marker=new google.maps.Marker({
          position: new google.maps.LatLng(lat,long),
          map: peta,
          icon: 'fire.png'
      })

      var infowindow = new google.maps.InfoWindow({
      content: 'Lokasi : '+id_lokasi+'<br>'+'Banyak Kejadian : '+kejadian
      })

      marker.addListener('click', function() {
          infowindow.open(peta, marker);
      });
     }
    }  
  
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>

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

<div class="row">
  <div class="side">
    <h3 align="center">Peta Persebaran Kebakaran</h3>
    <div id="googleMap" style="width:100%;height:400px;"></div>
  </div>
  <div class="main">
      <center>
          <h1>Cari Data</h1>
          	<form action="" method="POST">
         	 	Cari Data Berdasarkan 
         	 	<select name="column" required="">
         	 		<option value="nama_kecamatan">Kecamatan</option>
         	 		<option value="tanggal">Tanggal</option>
         	 		<option value="kebakaran.id_kebakaran">ID Kebakaran</option>
         	 		<option value="penyebab">Penyebab</option>
         	 		<option value="lokasi.id_lokasi">Lokasi</option>
         	 	</select>
         	 	<input type="text" name="cari">
         	 	<input type="submit" name="caridata" value="Cari">
         	</form>
         	<br><br>
          <table border="1" cellpadding="5" cellspacing="0" width="100%">
            <tr bgcolor="#bf4040" style="color: white">
              <th>Kecamatan</th>
              <th>ID Kebakaran</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Penyebab</th>
              <th>Lokasi</th>
              <th>Detail</th>
              <th>Hapus</th>
            </tr>
            <?php 

            $result = mysqli_query($conn,"SELECT kebakaran.id_kebakaran, kebakaran.tanggal, kebakaran.waktu, penyebab.penyebab, lokasi.id_lokasi, lokasi.latitude, lokasi.longitude, kecamatan.nama_kecamatan FROM kebakaran JOIN detail_lokasi ON kebakaran.id_kebakaran=detail_lokasi.id_kebakaran JOIN lokasi ON detail_lokasi.id_lokasi = lokasi.id_lokasi JOIN penyebab ON penyebab.id_penyebab=kebakaran.id_penyebab JOIN detail_kecamatan ON detail_kecamatan.id_kebakaran=kebakaran.id_kebakaran JOIN kecamatan ON kecamatan.id_kecamatan=detail_kecamatan.id_kecamatan WHERE $column LIKE '%$cari%'");

                            while($data = mysqli_fetch_assoc($result)){

                             ?>
                            
                             <tr style="text-align: center;">
                                      <td><?php echo $data['nama_kecamatan'] ?></td>
                                      <td><?php echo $data['id_kebakaran']; ?></td>
                                      <td><?php echo $data['tanggal']; ?></td>
                                      <td><?php echo $data['waktu']; ?></td>
                                      <td><?php echo $data['penyebab']; ?></td>
                                      <td><?php echo $data['id_lokasi']; ?></td>
                                      <td style="text-align: center;"><a href="detail.php?id_kebakaran=<?php echo $data['id_kebakaran']; ?>"><button class="button detail">Lihat</button></a></td>
                                      <td style="text-align: center;" onclick="return confirm('Anda Yakin?')"><a href="hapuskebakaran.php?id_kebakaran=<?php echo $data['id_kebakaran'];?>"><button class="button hapus" >Hapus</button></a></td>
                             </tr>
                <?php } ?>  
          </table>
        </center>
  </div>
</div>

<div class="footer">
  <h5>Copyright Kelompok 6</h5>
</div>

</body>
</html>