<?php 

include_once("koneksi.php");

$id_kebakaran = $_GET['id_kebakaran'];

if(isset($_POST['tambahlokasi'])){

  $id_lokasi = $_POST['id_lokasi'];
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  $id_kecamatan = $_POST['id_kecamatan'];

  $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lokasi WHERE id_lokasi='$id_lokasi'"));

  if($cek > 0){

    $result = mysqli_query($conn,"SELECT Max(kejadian) as kejadian FROM detail_lokasi WHERE id_lokasi='$id_lokasi'");

    $data = mysqli_fetch_assoc($result);

    $kejadian = $data[kejadian] + 1;

    $result2 = mysqli_query($conn, "INSERT INTO detail_lokasi values ('$id_kebakaran','$id_lokasi',$kejadian)");
    $result3 = mysqli_query($conn, "INSERT INTO detail_kecamatan values ('$id_kebakaran','$id_kecamatan')");

    header("Location:korban.php?id_kebakaran=$id_kebakaran");
  }else{
    $result = mysqli_query($conn, "INSERT INTO lokasi values ('$id_lokasi','$latitude','$longitude')");
    $result2 = mysqli_query($conn, "INSERT INTO detail_lokasi values ('$id_kebakaran','$id_lokasi',1)");
    $result3 = mysqli_query($conn, "INSERT INTO detail_kecamatan values ('$id_kebakaran','$id_kecamatan')");

    header("Location:korban.php?id_kebakaran=$id_kebakaran");
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

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANIx4N48kL_YEfp-fVeWmJ_3MSItIP8eI&callback=initMap"></script>
    <script>
      var marker
      function taruhMarker(peta, posisiTitik){
          // membuat Marker
          if( marker ){
            // pindahkan marker
            marker.setPosition(posisiTitik);
          } else {
            // buat marker baru
            marker = new google.maps.Marker({
              position: posisiTitik,
              map: peta
            });
          }
        console.log("Posisi marker: " + posisiTitik);
        document.getElementById("lat").value = posisiTitik.lat();
        document.getElementById("lng").value = posisiTitik.lng();
      }
        
      function initialize() {
        var propertiPeta = {
          center:new google.maps.LatLng( -0.913548, 100.4626),
          zoom:15,
          mapTypeId:'satellite'
        };
        
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        
        // even listner ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
          taruhMarker(this, event.latLng);
        });

      }

      // event jendela di-load  
      google.maps.event.addDomListener(window, 'load', initialize);

    </script>

</head>
<body>

<div class="header">
  <h1>SISTEM INFORMASI KEBENCANAAN KEBAKARAN</h1>
  <h2>Kota Padang</h2>
</div>

<div class="row" style="height: 600px;">
  <div class="side">
    <h3 align="center">Pilih Lokasi Pada Peta</h3>
    <div id="googleMap" style="width:100%;height:300px;"></div>
  </div>
  <div class="main">
      <div class="container">
        <center>
          <table>
            <form action="" method="POST">
              <tr>
                <h1>Tambah Data Lokasi Kejadian</h1>
              </tr>
              <tr>
                <td>Lokasi</td>
                <td><input type="text" name="id_lokasi" size="30" required oninvalid="this.setCustomValidity('Lokasi Tidak Boleh Kosong')"></td>
              </tr>
              <tr>
                <td>Kecamatan</td>
                <td>
                  <select name="id_kecamatan" required="">

                              <?php 

                              $koderesult = mysqli_query($conn,"SELECT * FROM kecamatan");
                              while($kode = mysqli_fetch_assoc($koderesult))  : ;  ?>

                                   <option value="<?php echo $kode['id_kecamatan'];?>"><?php echo $kode['nama_kecamatan'];?></option>

                             <?php endwhile; ?>

                  </select>
                </td>
              </tr>
              <tr>
                <td>Latitude</td>
                <td><input type="text" id="lat" name="latitude" value="" size="30"></td></tr>
              <tr>
                <td>Longitude</td>
                <td><input type="text" id="lng" name="longitude" value="" size="30"></td>
              </tr> 
              <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" name="tambahlokasi" value="Tambah" class="button submit"></td>
              </tr>
            </form>
          </table>
        </center>
        </div>
  </div>
</div>

<div class="footer">
  <h5>Copyright Kelompok 6</h5>
</div>

</body>
</html>